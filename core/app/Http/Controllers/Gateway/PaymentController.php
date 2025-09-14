<?php

namespace App\Http\Controllers\Gateway;

use App\Constants\Status;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\GatewayCurrency;
use App\Models\Rental;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Coupons;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function deposit()
    {
        $pageTitle = 'Payments Methods';
        $user = auth()->user();
        $rent = Rental::inactive()->where('user_id', $user->id)->where('id', session('rent_id'))->first();
//         dd($rent);
        if (!$rent) {
            $notify[] = ['error', 'Invalid request'];
            return to_route('user.home')->withNotify($notify);
        }
        // dd($rent);
        $gatewayCurrency = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', Status::ENABLE);
        })->with('method')->orderby('name')->get();

        return view('Template::user.payment.deposit', compact('gatewayCurrency', 'pageTitle', 'rent'));
    }

    public function updateRent(Request $request){

    }
public function depositInsert(Request $request)
{
    
    $request->validate([
        'amount' => 'required|numeric|gt:0',
        'gateway' => 'required',
        'currency' => 'required',
    ]);

    $user = auth()->user();
    $rent = Rental::inactive()->where('user_id', $user->id)
                    ->where('id', session('rent_id'))
                    ->first();
                    
    if (!$rent) {
        $notify[] = ['error', 'Invalid request rent not found from depositInsert'];
        return to_route('user.home')->withNotify($notify);
    }

    $gate = GatewayCurrency::whereHas('method', function ($gate) {
        $gate->where('status', Status::ENABLE);
    })->where('method_code', $request->gateway)
      ->where('currency', $request->currency)
      ->first();

      if (!$gate && $request->gateway!=201) {
        $notify[] = ['error', 'Invalid gateway'];
        return back()->withNotify($notify);
    }

    // Initialize variables
    $originalAmount = $rent->price;
    $discountAmount = 0;
    $coupon = null;
    $couponApplied = false;

    // Handle coupon if provided
    if ($request->has('coupon_code')) {
        $coupon = Coupons::where('code', $request->coupon_code)
                  ->where(function($query) {
                      $query->where('end_date', '>=', now())
                            ->orWhereNull('end_date');
                  })
                  ->first();

        if ($coupon) {
            // Check usage limits
            if ($coupon->use_limit > 0 && $coupon->use_count >= $coupon->use_limit) {
                $notify[] = ['error', 'This coupon has reached its usage limit'];
                return back()->withNotify($notify);
            }

            // Apply discount based on coupon type
            if ($coupon->type == 0) {
                $discountAmount = (float)($originalAmount * ($coupon->value / 100));
                $couponApplied = true;
            }
            elseif ($coupon->type == 1) {
                // For period coupons, we'll extend the rental period
                $rent->end_date = \Carbon\Carbon::parse($rent->end_date)
                                    ->addDays($coupon->value)
                                    ->format('Y-m-d');
                $couponApplied = true;
            }

            // Update coupon usage
            if ($couponApplied) {
                $coupon->use_count++;
                $coupon->save();

                // Store coupon info in rental record
                $rent->coupon_id = $coupon->id;
                $rent->coupon_discount = $discountAmount;
                $rent->save();
            }

        }
    }

    $data = new Deposit();
    
    if($request->gateway==201){
        $charge=0;
        $data->method_code = 201;
        $data->method_currency = "JD";
        $data->rate = 1;
        
    }else{
        $charge = $gate->fixed_charge + ($request->final_amount * $gate->percent_charge / 100);
        $data->method_code = $gate->method_code;
        $data->method_currency = strtoupper($gate->currency);
        $data->rate = $gate->rate;
        
    }
    $base = $request->amount;
    $tax = $request->tax_amount;

//     $charge = $gate->fixed_charge + (($base + $tax) * $gate->percent_charge / 100);

    $final_amount = $base + $tax + $charge;

    if($request->gateway==201 &&($request->final_amount > $user->balance)){
        $notify[] = ['error', ' Your Balance is '.number_format($user->balance,2)];
        $notify[] = ['error', 'You do not have enough credit!' ];
        
        return back()->withNotify($notify);
    }
//     dd($request->post());
    // Create deposit record
    $data->user_id = $user->id;
    $data->rent_id = $rent->id;
    $data->amount = $request->amount;
    $data->charge = $charge;
    $data->tax = $request->tax_amount;
    $data->final_amount = $request->final_amount;
//     $data->final_amount = $final_amount;
    $data->btc_amount = 0;
    $data->btc_wallet = "";
    $data->trx = $rent->rent_no;
    $data->coupon_id = $coupon?->id;
    $data->coupon_discount = $discountAmount;
    $data->success_url = urlPath('user.deposit.history');
    $data->failed_url = urlPath('user.deposit.history');
    $data->save();
    session()->put('Track', $data->trx);
    return to_route('user.deposit.confirm');
}

public function depositUpdateRent(Request $request,$rentId){

    dd($request->post());
}

    public function depositConfirm()
    {
        $track = session()->get('Track');
        $deposit = Deposit::where('trx', $track)->where('status',Status::PAYMENT_INITIATE)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($deposit->method_code >= 1000) {
            return to_route('user.deposit.manual.confirm');
        }

        if($deposit->method_code==201){
            $dirName="MyBalance";
        }else{
            $dirName = $deposit->gateway->alias;
        }
        $new = __NAMESPACE__ . '\\' . $dirName . '\\ProcessController';
        
        $data = $new::process($deposit);
        $data = json_decode($data);


        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return back()->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }
        
        // for Stripe V3
        if(@$data->session){
            $deposit->btc_wallet = $data->session->id;
            $deposit->save();
        }
//         dd($data);
        
        $pageTitle = 'Payment Confirm';
//         $deposits=Deposit::where('user_id',$deposit->user_id)->paginate();
        return view("Template::$data->view", compact('data', 'pageTitle', 'deposit'));
    }


    public static function userDataUpdate($deposit,$isManual = null)
    {
//         dd($deposit);
        if ($deposit->status == Status::PAYMENT_INITIATE || $deposit->status == Status::PAYMENT_PENDING) {
            $deposit->status = Status::PAYMENT_SUCCESS;
            $deposit->save();

            $user = User::find($deposit->user_id);
            

            $methodName = $deposit->methodName();
            if($deposit->method_code==201){
                $methodName = "MyBalance";
                
            }else{
                $user->balance += $deposit->final_amount;
                
                $transaction               = new Transaction();
                $transaction->user_id      = $deposit->user_id;
                $transaction->amount       = $deposit->final_amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge       = $deposit->charge;
                $transaction->trx_type     = '+';
                $transaction->details      = 'Payment Via ' . $methodName;
                $transaction->trx          = $deposit->trx;
                $transaction->remark       = 'payment';
                $transaction->save();
                
                
            }
            

            $user->balance -= $deposit->final_amount;
            $user->save();
            
            $transaction               = new Transaction();
            $transaction->user_id      = $deposit->user_id;
            $transaction->amount       = $deposit->final_amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge       = $deposit->charge;
            $transaction->trx_type     = '-';
            $transaction->details      = 'Payment Via ' . $methodName;
            $transaction->trx          = $deposit->trx;
            $transaction->remark       = 'payment';
            $transaction->save();

            $rent         = Rental::where('user_id', $deposit->user_id)->where('id', $deposit->rent_id)->first();
            $rent->status = Status::RENT_PENDING;
            $rent->save();

            Log::info('MyBalance payment rent:'. $rent);
            
            $vehicle         = $rent->vehicle;
            $vehicle->rented = Status::YES;
            $vehicle->save();


            if (!$isManual) {
                $adminNotification            = new AdminNotification();
                $adminNotification->user_id   = $user->id;
                $adminNotification->title     = 'Payment successful via '.$methodName;
                $adminNotification->click_url = urlPath('admin.deposit.successful');
                $adminNotification->save();
            }

            notify($user, $isManual ? 'PAYMENT_APPROVE' : 'PAYMENT_COMPLETE', [
                'method_name' => $methodName,
                'method_currency' => $deposit->method_currency,
                'method_amount' => showAmount($deposit->final_amount,currencyFormat:false),
                'amount' => showAmount($deposit->amount,currencyFormat:false),
                'charge' => showAmount($deposit->charge,currencyFormat:false),
                'rate' => showAmount($deposit->rate,currencyFormat:false),
                'trx' => $deposit->trx,
                'post_balance' => showAmount($user->balance)
            ]);

            notify($vehicle->user, 'VEHICLE_RENTAL_REQUEST', [
                'username'    => @$vehicle->user->username,
                'rented_user' => $user->username,
                'rent_no'     => $rent->rent_no,
                'brand'       => $vehicle->brand->name,
                'name'        => $vehicle->name,
                'model'       => $vehicle->model,
                'price'       => showAmount($rent->price),
                'start_date'  => $rent->start_date." - ".$rent->pickup_time??"00:00",
                'end_date'    => $rent->end_date." - ".$rent->dropoff_time??"00:00",
                'pickup'      => @$rent->pickupPoint->name,
                'dropoff'     => @$rent->dropPoint->name,
            ]);

            notify($user, 'RENTAL_REQUEST', [
                'username'   => $user->username,
                'rent_no'    => $rent->rent_no,
                'brand'      => $vehicle->brand->name,
                'name'       => $vehicle->name,
                'model'      => $vehicle->model,
                'price'      => showAmount($rent->price),
                'start_date' => $rent->start_date." - ".$rent->pickup_time??"00:00",
                'end_date'   => $rent->end_date." - ".$rent->dropoff_time??"00:00",
                'pickup'     => @$rent->pickupPoint->name,
                'dropoff'    => @$rent->dropPoint->name,
            ]);
        }
    }

    public function manualDepositConfirm()
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        if ($data->method_code > 999) {
            $pageTitle = 'Confirm Payment';
            $method = $data->gatewayCurrency();
            $gateway = $method->method;
            return view('Template::user.payment.manual', compact('data', 'pageTitle', 'method','gateway'));
        }
        abort(404);
    }

    public function manualDepositUpdate(Request $request)
    {
        $track = session()->get('Track');
        $data = Deposit::with('gateway')->where('status', Status::PAYMENT_INITIATE)->where('trx', $track)->first();
        abort_if(!$data, 404);
        $gatewayCurrency = $data->gatewayCurrency();
        $gateway = $gatewayCurrency->method;
        $formData = $gateway->form->form_data;

        $formProcessor = new FormProcessor();
        $validationRule = $formProcessor->valueValidation($formData);
        $request->validate($validationRule);
        $userData = $formProcessor->processFormData($request, $formData);


        $data->detail = $userData;
        $data->status = Status::PAYMENT_PENDING;
        $data->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $data->user->id;
        $adminNotification->title = 'Payment request from '.$data->user->username;
        $adminNotification->click_url = urlPath('admin.deposit.details',$data->id);
        $adminNotification->save();

        notify($data->user, 'DEPOSIT_REQUEST', [
            'method_name' => $data->gatewayCurrency()->name,
            'method_currency' => $data->method_currency,
            'method_amount' => showAmount($data->final_amount,currencyFormat:false),
            'amount' => showAmount($data->amount,currencyFormat:false),
            'charge' => showAmount($data->charge,currencyFormat:false),
            'rate' => showAmount($data->rate,currencyFormat:false),
            'trx' => $data->trx
        ]);

        $notify[] = ['success', 'Your payment request has been taken'];
        return to_route('user.deposit.history')->withNotify($notify);
    }


}
