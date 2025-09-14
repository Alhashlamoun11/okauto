<?php

namespace App\Http\Controllers\User;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Rental;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Zone;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Models\Deposit;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{

    public function TestNotification($message){
        $users=User::all();
            $verificationCode = rand(100000, 999999);

        foreach($users as $user){
                    notify($user, 'DEFAULT', [
            'subject'     => "testing notification",
            "message"=>$message,

        ]);

        }
    }
    public function rentVehicle(Request $request, $id)
    {

        try {
            $date = explode(' - ', $request->date);
            $startDate = Carbon::parse(trim($date[0]))->format('Y-m-d');
            $endDate = @$date[1] ? Carbon::parse(trim(@$date[1]))->format('Y-m-d') : $startDate;

            // Combine date and time for precise start and end
            $startDateTime = Carbon::parse($startDate . ' ' . $request->pickup_time);
            $endDateTime = Carbon::parse($endDate . ' ' . $request->dropoff_time);
        } catch (Exception $e) {
            $notify[] = ['error', 'Invalid date or time format'];
            return back()->withNotify($notify);
        }



        // Validate other inputs
        $request->validate([
            'drop_off_zone_id'     => 'required|integer|gt:0',
            'pick_up_location_id'  => 'required|integer|gt:0',
            'note'                 => 'nullable|string|max:255',
            //'drop_off_location_id' => 'required|integer|gt:0',
//             'pickup_time'          => 'required|date_format:H:i',
//             'dropoff_time'         => 'required|date_format:H:i',
        ]);

        // Check vehicle availability
        if (!isset($request->extend)) {
            $vehicle = Vehicle::where('id', $id)
            ->available()
            ->whereDoesntHave('rental', function ($query) use ($startDateTime, $endDateTime) {
                $query->whereIn('status', [Status::RENT_PENDING, Status::RENT_ON_GOING, Status::RENT_APPROVED])
                ->where('start_date', '<=', $endDateTime)
                ->where('end_date', '>=', $startDateTime);
            })->first();
        } else {
            $startDateTime = $startDateTime->addDay();
            $vehicle = Vehicle::where('id', $id)->available()->first();
        }

        if (!$vehicle) {
            $notify[] = ['error', 'This vehicle isn\'t available for the selected date/time'];
            return back()->withNotify($notify);
        }

        if (!isset($request->extend) && (!$request->date || !$request->pickup_time || !$request->dropoff_time)) {
            $notify[] = ['error', 'Date and time fields are required'];
            return back()->withNotify($notify);
        }

        // Check if start date/time is in the past (unless extending)
        if (!isset($request->extend) && $startDateTime < now()) {
            $notify[] = ['error', 'The start date/time is invalid'];
            return back()->withNotify($notify);
        }


        if (!isset($request->extend)) {
            $startDateTime2 = \Carbon\Carbon::parse($startDate . ' ' . $request->pickup_time);
            $endDateTime2 = \Carbon\Carbon::parse($endDate . ' ' . $request->dropoff_time);

            if ($endDateTime->lte($startDateTime)) {
                $notify[] = ['error', 'The end date/time must be after the start date/time.'];
                return back()->withNotify($notify);
            }

            $sameDay = $startDateTime2->isSameDay($endDateTime2);

            $dayHours = $vehicle->day_hours ?? 24;

            $diffInHours2 = $startDateTime2->diffInHours($endDateTime2);

//             dd([
//                 'startDateTime' => $startDateTime->toDateTimeString(),
//                 'endDateTime' => $endDateTime->toDateTimeString(),
//                 'diff_hours' => $diffInHours2,
//                 'dayHours_required' => $dayHours,
//                 'violates' => $diffInHours2 < 1,
//             ]);
            $totalHours = $startDateTime->diffInHours($endDateTime);

            if ($diffInHours2 < $dayHours) {
                $notify[] = ['error', 'The end date/time must be at least '.$dayHours.' hour after the start.'];
                return back()->withNotify($notify);
            }
        }else{

            $startDateTime2 = \Carbon\Carbon::parse($request->end_date . ' ' . $request->dropoff_time);

            $endDateTime2  = \Carbon\Carbon::parse($request->new_end_date);

            $sameDay = $startDateTime2->isSameDay($endDateTime);

            $dayHours = $vehicle->day_hours ?? 24;

            $diffInHours2 = $startDateTime2->diffInHours($endDateTime2, false);

            $totalHours = $startDateTime2->diffInHours($endDateTime2);

//             dd([
//                 'startDateTime' => $startDateTime2->toDateTimeString(),
//                 'endDateTime' => $endDateTime2->toDateTimeString(),
//                 'diff_hours' => $diffInHours2,
//                 'dayHours_required' => $dayHours,
//                 'violates' => $diffInHours2 < 1,
//             ]);

            if ($diffInHours2 < $dayHours) {
                $notify[] = ['error', 'The end date/time must be at least '.$dayHours.' hour after the start.'];
                return back()->withNotify($notify);
            }

        }



        $user = auth()->user();

        if ($vehicle->user_id == $user->id) {
            $notify[] = ['error', 'You can\'t rent your own vehicle'];
            return back()->withNotify($notify);
        }

        $pickUpLocation = Location::with('user')->where('id', $request->pick_up_location_id)->first();
        if (!$pickUpLocation) {
            $notify[] = ['error', 'Pick up location is invalid'];
            return back()->withNotify($notify);
        }

        $zone = Zone::where('id', $request->drop_off_zone_id)->first();
        if (!$zone) {
            $notify[] = ['error', 'Drop off zone is invalid'];
            dd($notify);

            return back()->withNotify($notify);
        }

//         dd($request->post());
        $dropOffLocation = Location::with('user')->where('id', $request->drop_off_location_id)->first();
        if (!isset($request->extend) && !$dropOffLocation) {
            $notify[] = ['error', 'Drop off location is invalid'];
//             dd($dropOffLocation);

            return back()->withNotify($notify);
        }

        // Calculate total hours and convert to "days" based on day_hours
        $dayHours = $vehicle->day_hours ?? 24; // Default to 24 hours if not set
        $totalDays = (float)($totalHours / $dayHours);

        $rentPrice = (float)$vehicle->price * $totalDays;

        $extraServices = $request->extra_services ?? [];
        $totalExtraPrice = 0;


        $age = Carbon::parse($user->birthdate)->age;

        if ($age < $vehicle->user->allowed_age) {
            $notify[] = ['error', 'You must be at least ' . $vehicle->user->allowed_age . ' years old to rent this vehicle'];
            return back()->withNotify($notify);
        }

        foreach ($extraServices as $service) {
            if (isset($service['price'])) {
                $totalExtraPrice += floatval($service['price']);
            }
        }

//         $finalPrice = $rentPrice + $totalExtraPrice;
//         dd([$rentPrice ,$totalHours,$dayHours,$totalDays]);
        // Save rental details
        $rent = new Rental();
        $rent->user_id = $user->id;
        $rent->vehicle_user_id = $vehicle->user_id;
        $rent->vehicle_id = $vehicle->id;
        $rent->pick_up_zone_id = $pickUpLocation->user->zone_id;
        $rent->drop_off_zone_id = $zone->id;
        $rent->pick_up_location_id = $pickUpLocation->id;
        $rent->drop_off_location_id = $dropOffLocation->id ?? $pickUpLocation->id;
        $rent->start_date = $startDateTime;
        $rent->end_date = $endDateTime;
        $rent->pickup_time = $request->pickup_time;
        $rent->dropoff_time = $request->dropoff_time;
        $rent->price = (float)$rentPrice;
        $rent->extra_services_amount = (float)$totalExtraPrice;
        $rent->status = Status::RENT_INITIATE;
        $rent->rent_no = getTrx();
        $rent->note = $request->note;

        $rent->save();

        if (!empty($extraServices)) {
            foreach ($extraServices as $serviceId => $serviceData) {
                DB::table('rental_extra_services')->insert([
                    'rental_id' => $rent->id,
                    'extra_service_id' => $serviceId,
                    'price' => $serviceData['price'],
                    'quantity' => 1,
                ]);
            }
        }

        session()->put('rent_id', $rent->id);
        return redirect()->route('user.deposit.index');
    }
    public function index()
    {
        $pageTitle = 'All Rental Vehicle';
        $rentals   = $this->getRentData('');
        return view('Template::user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function pending()
    {
        $pageTitle = 'Pending Rental Vehicle';
        $rentals   = $this->getRentData('pending');
        return view('Template::user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function approved()
    {
        $pageTitle = 'Approved Rental Vehicle';
        $rentals   = $this->getRentData('approved');
        return view('Template::user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function ongoing()
    {
        $pageTitle = 'Ongoing Rental Vehicle';
        $rentals   = $this->getRentData('ongoing');
        return view('Template::user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function completed()
    {
        $pageTitle = 'Completed Rental Vehicle';
        $rentals   = $this->getRentData('completed');
        return view('Template::user.rental.index', compact('pageTitle', 'rentals'));
    }
    public function cancelled()
    {
        $pageTitle = 'Cancelled Rental Vehicle';
        $rentals   = $this->getRentData('cancelled');
        return view('Template::user.rental.index', compact('pageTitle', 'rentals'));
    }

    protected function getRentData($scope)
    {
        $rentals = Rental::where('vehicle_user_id', auth()->id());
        if ($scope) {
            $rentals->$scope();
        }
        return $rentals->searchable(['rent_no'])->with(['user:id,username', 'vehicle.brand'])->paginate(getPaginate());
    }

    public function detail($id)
    {
        $pageTitle = 'Rental Detail';
        $rent      = Rental::where('vehicle_user_id', auth()->id())->findOrFail($id);
        $deposit=Deposit::where('rent_id',$rent->id)->first();
        return view('Template::user.rental.detail', compact('pageTitle', 'rent','deposit'));
    }

    public function approve($id)
    {

        $rent = Rental::pending()->withWhereHas('vehicle', function ($query) {
            $query->where('user_id', auth()->id())->available();
        })->find($id);

        if($rent==null){
            $notify[] = ['error', 'Vehicle is not available for approve now!'];
            return back()->withNotify($notify);

        }
        // dd($rent);
        $rent->status = Status::RENT_APPROVED;
        $rent->save();

        $user = $rent->user;
        notify($user, 'RENTAL_APPROVED', [
            'username'   => $user->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date." - ".$rent->pickup_time??"00:00",
            'end_date'   => $rent->end_date." - ".$rent->dropoff_time??"00:00",
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $notify[] = ['success', 'Rental request approved successfully'];
        return back()->withNotify($notify);
    }

    public function cancel(Request $request,$id)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        $rent = Rental::where(function ($q) {
            $q->where('status', Status::RENT_PENDING)->orWhere('status', Status::RENT_APPROVED);
        })->find($id);

        if($rent==null){
            $notify[] = ['error', 'somthing is went wrong!!!'];
            return back()->withNotify($notify);

        }

        $rent->status = Status::RENT_CANCELLED;
            $rent->update_date_status = 0;
            $rent->cancellation_reason = $request->reason;

        $rent->save();

        $vehicle         = $rent->vehicle;
        $vehicle->rented = Status::NO;
        $vehicle->save();

        $now = \Carbon\Carbon::now();

        $created_at = \Carbon\Carbon::parse($rent->created_at);
        $hoursDifference = $now->diffInHours($created_at, true); // false gives signed difference
        $deposit=Deposit::where('rent_id',$rent->id)->first();
        // Can cancel if current time is before end_date AND
        // the remaining hours are more than cancellation_hours
        // dd([$hoursDifference,$now]);
        // dd($now);
        $canCancel = ($hoursDifference > 0 && $hoursDifference < $rent->vehicle->user->cancelation_hours) && ($rent->status==Status::RENT_APPROVED || $rent->status==Status::RENT_PENDING);

        $user = $rent->user;
        $deposit=Deposit::where('rent_id',$rent->id)->first();
        $user->balance += $deposit->final_amount;
//         if($canCancel){
//             $deposit=Deposit::where('rent_id',$rent->id)->fist();


//             $user->balance += $deposit->final_amount;

//     }else{
//         $user->balance += ($rent->price + $rent->extra_services_amount);
//         }
        $user->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $rent->user_id;
        $transaction->amount       = $deposit->final_amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Payment refund for cancellation rent request';
        $transaction->trx          = getTrx();
        $transaction->remark       = 'payment_refund';
        $transaction->save();

        
//         $rent->vehicleOwner->balance -= (($deposit->amount+$deposit->tax+$deposit->extra_services_amount)-(($deposit->amount+$deposit->tax+$deposit->extra_services_amount)*(gs('rental_charge')/100)));
//         $rent->vehicleOwner->save();
//         $transaction               = new Transaction();
//         $transaction->user_id      = $rent->vehicle_user_id ;
//         $transaction->amount       = (($deposit->amount+$deposit->tax+$deposit->extra_services_amount)-(($deposit->amount+$deposit->tax+$deposit->extra_services_amount)*(gs('rental_charge')/100)));
//         $transaction->post_balance = $rent->vehicleOwner->balance;
//         $transaction->charge       = 0;
//         $transaction->trx_type     = '-';
//         $transaction->details      = 'Payment refund for cancellation rent request';
//         $transaction->trx          = getTrx();
//         $transaction->remark       = 'payment_refund';
//         $transaction->save();
        
        notify($rent->vehicleOwner, 'RENTAL_CANCELLED', [
            'username'     => $user->username,
            'rent_no'      => $rent->rent_no." <br>Cancel Reason: ".($request->reason??"")."<br><br>",
            'brand'        => @$rent->vehicle->brand->name,
            'name'         => @$rent->vehicle->name,
            'model'        => @$rent->vehicle->model,
            'price'        => showAmount($rent->price),
            'start_date'   => $rent->start_date." - ".$rent->pickup_time??"00:00",
            'end_date'     => $rent->end_date." - ".$rent->dropoff_time??"00:00",
            'pickup'       => @$rent->pickupPoint->name,
            'dropoff'      => @$rent->dropPoint->name,
            'post_balance' => $user->balance,
        ]);

        notify($user, 'RENTAL_CANCELLED', [
            'username'     => $user->username,
            'rent_no'      => $rent->rent_no." <br><span><b>Cancel Reason: ".($request->reason??"")."</b></span><br><br>",
            'brand'        => @$rent->vehicle->brand->name,
            'name'         => @$rent->vehicle->name,
            'model'        => @$rent->vehicle->model,
            'price'        => showAmount($rent->price),
            'start_date'   => $rent->start_date." - ".$rent->pickup_time??"00:00",
            'end_date'     => $rent->end_date." - ".$rent->dropoff_time??"00:00",
            'pickup'       => @$rent->pickupPoint->name,
            'dropoff'      => @$rent->dropPoint->name,
            'post_balance' => $user->balance,
        ]);

        $notify[] = ['success'=>true, 'msg'=>'Rental request cancelled successfully'];
        return back()->withNotify($notify);
    }

    public function sendOnGoingVerifyCode($id,$withReturn=true){
        $rent = Rental::approved()->withWhereHas('vehicle', function ($query) {
            $query->where('user_id', auth()->id());
        })->find($id);

            $verificationCode = rand(100000, 999999);

            $rent->verify_code=$verificationCode;
            $rent->save();

            $user=$rent->user;
            notify($user, 'APPROVED_ONGOING_STATUS', [
                'username' => $rent->user->username,
                'rent_no' => $rent->rent_no,
                'verification_code' => $verificationCode,
                'vehicle' => $rent->vehicle->brand->name.' '.$rent->vehicle->name,
            ]);
        return response()->json([
            'success'=>true,
            'msg'=>"message send successfully"]);
    }

    public function ongoingStatus(Request $request,$id) {
        $rent = Rental::approved()->withWhereHas('vehicle', function ($query) {
            $query->where('user_id', auth()->id())->available();
        })->find($id);

        if($rent==null){
            $notify[] = ['error', 'Vehicle is not available now!'];
            return back()->withNotify($notify);

        }

        if($rent->verify_code!=$request->verification_code){
            $notify[] = ['error', 'Wrong Code Number!'];
            return back()->withNotify($notify);
        }

        $rent->status = Status::RENT_ON_GOING;
        $rent->save();

        $user = $rent->user;
        notify($user, 'RENTAL_ONGOING', [
            'username'   => $user->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date." - ".$rent->pickup_time??"00:00",
            'end_date'   => $rent->end_date." - ".$rent->dropoff_time??"00:00",
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $vehicleOwner = $rent->vehicle->user;
        notify($vehicleOwner, 'RENTAL_VEHICLE_RECEIVED', [
            'username'   => $vehicleOwner->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date." - ".$rent->pickup_time??"00:00",
            'end_date'   => $rent->end_date." - ".$rent->dropoff_time??"00:00",
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $notify[] = ['success', 'Rental ongoing successfully'];
        return back()->withNotify($notify);
    }

    public function completeStatus($id)
    {



        $rent         = Rental::findOrFail($id);
        $deposit=Deposit::where('rent_id',$rent->id)->first();

        $rent->status = Status::RENT_COMPLETED;
//         dd([$deposit,$rent]);
        $rent->save();

        $vehicle         = $rent->vehicle;
        $vehicle->rented = Status::NO;
        $vehicle->save();

        $vehicleOwner = $rent->vehicle->user;
        $vehicleOwner->balance += (float)($deposit->amount+$rent->extra_services_amount+$deposit->tax);
//         $vehicleOwner->balance += $deposit->amount;
        
//         dd($vehicleOwner);
        $vehicleOwner->save();

        $trx = getTrx();



        $transaction               = new Transaction();
        $transaction->user_id      = $vehicleOwner->id;
        $transaction->amount       = (float)($deposit->amount+$rent->extra_services_amount+$deposit->tax);
        $transaction->post_balance = $vehicleOwner->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '+';
        $transaction->details      = 'Rental amount has been added to the wallet';
        $transaction->trx          = $trx;
        $transaction->remark       = 'rental_payment';
        $transaction->save();

        $charge = (float)($deposit->amount+$rent->extra_services_amount+$deposit->tax) * (gs('rental_charge') / 100);
        $vehicleOwner->balance -= $charge;
        $vehicleOwner->save();

        $transaction               = new Transaction();
        $transaction->user_id      = $vehicleOwner->id;
        $transaction->amount       = $charge;
        $transaction->post_balance = $vehicleOwner->balance;
        $transaction->charge       = 0;
        $transaction->trx_type     = '-';
        $transaction->details      = 'Rental charge has been deducted from the wallet';
        $transaction->trx          = $trx;
        $transaction->remark       = 'rental_charge';
        $transaction->save();

        $user = $rent->user;
        notify($user, 'RENTAL_COMPLETED', [
            'username'   => $user->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date." - ".$rent->pickup_time??"00:00",
            'end_date'   => $rent->end_date." - ".$rent->dropoff_time??"00:00",
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        notify($vehicleOwner, 'VEHICLE_RETURN_CONFIRMATION', [
            'username'   => $vehicleOwner->username,
            'rent_no'    => $rent->rent_no,
            'brand'      => @$rent->vehicle->brand->name,
            'name'       => @$rent->vehicle->name,
            'model'      => @$rent->vehicle->model,
            'price'      => showAmount($rent->price),
            'start_date' => $rent->start_date." - ".$rent->pickup_time??"00:00",
            'end_date'   => $rent->end_date." - ".$rent->dropoff_time??"00:00",
            'pickup'     => @$rent->pickupPoint->name,
            'dropoff'    => @$rent->dropPoint->name,
        ]);

        $notify[] = ['success', 'Rental ongoing successfully'];
        return to_route('user.ongoing.rental.list')->withNotify($notify);
    }

public function ChangeRentEndDate(Request $request)
{

    $rent = Rental::findOrFail($request->rentId);

    // // Verify new end date is after current end date
    // if (Carbon::parse($request->update_end_date) <= $rent->end_date) {
    //     $notify[] = ['error', 'New end date must be after current end date'];
    //     return back()->withNotify($notify);
    // }

    // Check vehicle availability for new dates
    // $isAvailable = Vehicle::where('id', $rent->vehicle_id)
    //     ->whereDoesntHave('rental', function($query) use ($rent, $request) {
    //         $query->where('id', '!=', $rent->id)
    //               ->whereIn('status', [Status::RENT_PENDING, Status::RENT_APPROVED, Status::RENT_ON_GOING])
    //               ->where('start_date', '<=', $request->update_end_date)
    //               ->where('end_date', '>=', $rent->start_date);
    //     })->exists();

    // if (!$isAvailable) {
    //     $notify[] = ['error', 'Vehicle is not available for the selected dates'];
    //     return back()->withNotify($notify);
    // }
    // Generate verification code
    $verificationCode = rand(100000, 999999);

    $rent->update_end_date = $request->new_end_date;
    $rent->update_date_status = 1;
    $rent->verify_code = $verificationCode;
        $vehicleOwner = $rent->vehicle->user;

    // dd($request->new_end_date);

    $rent->save();
    // Calculate price difference
    $oldDays = Carbon::parse($rent->start_date)->diffInDays($rent->end_date) + 1;
    $newDays = Carbon::parse($rent->start_date)->diffInDays($request->update_end_date) + 1;
    $priceDifference = $rent->vehicle->price * ($newDays - $oldDays);

    // Notify renter


    $user = $rent->user;
    notify($vehicleOwner, 'CHANGE_RESERVATION_PERIOD', [
        'username' => $rent->user->username,
        'rent_no' => $rent->rent_no,
        'current_end_date' => $rent->end_date." - ".$rent->pickup_time??"00:00",
        'proposed_end_date' => $request->new_end_date." - ".$rent->dropoff_time??"00:00",
        'verification_code' => $verificationCode,
        'price_difference' => showAmount($priceDifference),
        'vehicle' => $rent->vehicle->brand->name.' '.$rent->vehicle->name,
    ]);



    $notify[] = ['success', 'Extension request sent successfully. Waiting for customer approval.'];
    return response()->json(['success'=>true]);
}

    public function approveDateChange(Request $request){

        $rent=Rental::findOrFail($request->rent_id);

            $rent->end_date = $rent->update_end_date;
    $rent->update_end_date = null;
    $rent->update_date_status = null;
    $rent->verify_code = null;
    $rent->save();

    $user = $rent->user;

    notify($user, 'CHANGE_RESERVATION_APPROVED', [
        'username' => $rent->user->username,
        'rent_no' => $rent->rent_no,
        'current_end_date' => $rent->end_date." - ".$rent->pickup_time??"00:00",
        'proposed_end_date' => $request->new_end_date." - ".$rent->dropoff_time??"00:00",
        'vehicle' => $rent->vehicle->brand->name.' '.$rent->vehicle->name,
    ]);


    // Add any additional logic (price adjustment, notifications, etc.)

    return response()->json([
        'message' => __('Date change approved successfully')
    ]);
    }

    public function rejectDateChange(Request $request){
    $rent = Rental::findOrFail($request->rent_id);

    // Clear the update request
    $rent->update_end_date = null;
    $rent->update_date_status = null;
    $rent->verify_code = null;
    $rent->save();
    $user = $rent->user;

    notify($user, 'CHANGE_RESERVATION_REJECTED', [
        'username' => $rent->user->username,
        'rent_no' => $rent->rent_no,
        'current_end_date' => $rent->end_date." - ".$rent->pickup_time??"00:00",
        'proposed_end_date' => $request->new_end_date." - ".$rent->dropoff_time??"00:00",
        'vehicle' => $rent->vehicle->brand->name.' '.$rent->vehicle->name,
    ]);

    // Add any additional logic (notifications, etc.)

    return response()->json([
        'message' => __('Date change rejected successfully')
    ]);
    }

}
