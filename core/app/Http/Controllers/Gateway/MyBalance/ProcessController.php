<?php

namespace App\Http\Controllers\Gateway\MyBalance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function GuzzleHttp\json_decode;

class ProcessController extends Controller
{
    /**
     * Process a payment using MyBalance
     *
     * @param Deposit $deposit
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public static function process($deposit)
    {
        try {
            
            $general = gs();
            // Prepare data for payment form view
            $send = [
                'val' => [
                    'checkoutId' => $deposit->trx,
                    'return' =>route('ipn.mybalance',$deposit->trx),
                ],
                'view' => 'user.payment.MyBalance',
                'method' => 'get',
                'url' => route('home'),
            ];
//             Log::error('MyBalance proccess:', $send);
            
            return json_encode($send);
        } catch (\Exception $e) {
            Log::error('MyBalance process error: ' . $e->getMessage(), ['deposit_id' => $deposit->id]);
            Log::error($e);
            dd($e->getMessage());
            return redirect()->route('home')->with('error', 'An error occurred during payment processing.');
        }
    }
    
    /**
     * Handle MyBalance IPN (Instant Payment Notification)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ipn(Request $request,$trx=null)
    {
        try{
            $deposit = Deposit::where('trx', $trx)->first();
            
            // Update user data
                PaymentController::userDataUpdate($deposit);
                
                Log::info('MyBalance IPN: Payment successful', [
                    'deposit_id' => $deposit->id,
                    'trx' => $deposit->trx,
                    'amount' => $deposit->final_amount,
                ]);
                
                return redirect()->route('user.deposit.history')->with(['Payment completed successfully.']);
            
        } catch (\Exception $e) {
            Log::error('MyBalance IPN exception: ' . $e->getMessage(), [
//                 'resourcePath' => $resourcePath,
                'trx' => $trx,
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('user.deposit.history')->with(['An error occurred while verifying payment.']);
            
        }
    }
}