<?php

namespace App\Http\Controllers\Gateway\HyperPay;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\json_decode;

class ProcessController extends Controller
{
    /**
     * Process a payment using HyperPay
     *
     * @param Deposit $deposit
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public static function process($deposit)
    {
        try {
            $general = gs();
            $hyperpayAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
            $user = $deposit->user;
            
            // Prepare data for HyperPay checkout
            $data = [
                'entityId' => $hyperpayAcc->entityId,
                'amount' => number_format($deposit->final_amount, 2, '.', ''), // e.g., 100.00
                'currency' => 'JOD',
                'paymentType' => 'DB',
                'testMode' => $hyperpayAcc->testMode,
                'merchantTransactionId' => $deposit->trx,
                'customer.email' => $user->email,
                'billing.street1' => $user->address ?? 'Unknown',
                'billing.city' => $user->city ?? 'Amman',
                'billing.state' => $user->state ?? 'Amman',
                'billing.country' => $user->country_code ?? 'JO',
                'billing.postcode' => $user->zip ?? '11111',
                'customer.givenName' => $user->firstname ?? $user->username,
                'customer.surname' => $user->lastname ?? $user->username,
                'customParameters[3DS2_enrolled]' => 'true',
            ];
            
            // Send POST request to HyperPay to prepare checkout
            $url = 'https://eu-test.oppwa.com/v1/checkouts';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $hyperpayAcc->accessToken,
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                Log::error('HyperPay checkout error: ' . curl_error($ch), ['deposit_id' => $deposit->id]);
                dd(curl_errno($ch));
                return redirect()->route('home')->with('error', 'Payment initiation failed.');
            }
            curl_close($ch);
            
            $responseData = json_decode($response, true);
            if (!$responseData || !isset($responseData['id'])) {
                Log::error('HyperPay checkout invalid response: ' . $response, ['deposit_id' => $deposit->id]);
                dd($response);
                
                return redirect()->route('home')->with('error', 'Failed to initialize payment.');
            }
            
            // Prepare data for payment form view
            $send = [
                'val' => [
                    'checkoutId' => $responseData['id'],
                    'return' => route('ipn.HyperPay',$deposit->trx),
                ],
                'view' => 'user.payment.hyperPay_redirect',
                'method' => 'get',
                'url' => route('home'),
            ];
//             Log::error('HyperPay proccess:', $send);
            
            return json_encode($send);
        } catch (\Exception $e) {
            Log::error('HyperPay process error: ' . $e->getMessage(), ['deposit_id' => $deposit->id]);
            dd($e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred during payment processing.');
        }
    }
    
    /**
     * Handle HyperPay IPN (Instant Payment Notification)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ipn(Request $request,$trx=null)
    {
        try {
            // Log incoming request for debugging
            Log::info('HyperPay IPN request received', [
                'query_params' => $request->query(),
                'ip' => $request->ip(),
            ]);
            // Extract resourcePath and transaction ID
            $resourcePath = $request->query('resourcePath');
            $id = $request->query('id');
            
            // Validate inputs
            if (!$resourcePath || !$trx) {
                Log::error('HyperPay IPN: Missing resourcePath or transaction ID', [
                    'resourcePath' => $resourcePath,
                    'trx' => $trx,
                ]);
//                 dd("HyperPay IPN: Missing resourcePath or transaction ID");
                return redirect()->route('user.deposit.history')->with(['Invalid payment data.']);
                
            }
            
            // Find deposit
            $deposit = Deposit::where('trx', $trx)->first();
            if (!$deposit) {
                dd("HyperPay IPN: Deposit not found");
                
                Log::error('HyperPay IPN: Deposit not found', ['trx' => $trx]);
                return redirect()->route('user.deposit.history')->with(['An error occurred while verifying payment.']);
                
            }
            
            // Get HyperPay credentials
            $hyperpayAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter, true);
            $entityId = $hyperpayAcc['entityId'];
            $accessToken = $hyperpayAcc['accessToken'];
            
            // Construct URL for payment status
            $url = 'https://eu-test.oppwa.com' . $resourcePath . '?entityId=' . urlencode($entityId);
            Log::info('HyperPay IPN: Fetching payment status', ['url' => $url]);
            
            // Send GET request to HyperPay
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken,
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Set to true in production
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if (curl_errno($ch)) {
                Log::error('HyperPay IPN cURL error: ' . curl_error($ch), [
                    'deposit_id' => $deposit->id,
                    'url' => $url,
                ]);
                curl_close($ch);
                return redirect()->route('user.deposit.history')->with([ 'Failed to verify payment status.']);

            }
            curl_close($ch);
            
            // Decode response
            $responseData = json_decode($response, true);
            Log::info('HyperPay IPN response', [
                'deposit_id' => $deposit->id,
                'response' => $responseData,
                'http_code' => $httpCode,
            ]);
            
            if (!$responseData || !isset($responseData['result']['code'])) {
                Log::error('HyperPay IPN: Invalid or empty response', [
                    'deposit_id' => $deposit->id,
                    'response' => $response,
                    'http_code' => $httpCode,
                ]);
                return redirect()->route('user.deposit.history')->with(['Invalid payment response.']);
            }
            
            // Validate payment success
            $isSuccess = preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $responseData['result']['code']);
                // Update deposit
                $deposit->detail = $responseData;
                $deposit->save();
                
                // Update user data
                PaymentController::userDataUpdate($deposit);
                
                Log::info('HyperPay IPN: Payment successful', [
                    'deposit_id' => $deposit->id,
                    'trx' => $deposit->trx,
                    'amount' => $responseData['amount'],
                ]);
                
                return redirect()->route('user.deposit.history')->with(['Payment completed successfully.']);
            
        } catch (\Exception $e) {
            Log::error('HyperPay IPN exception: ' . $e->getMessage(), [
                'resourcePath' => $resourcePath,
                'trx' => $trx,
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('user.deposit.history')->with(['An error occurred while verifying payment.']);
            
        }
    }
}