<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponsController extends Controller {
    public function index() {
        $pageTitle = 'All Coupons';
        $coupons    = Coupons::searchable(['name'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.coupons.index', compact('pageTitle', 'coupons'));
    }

        public function store(Request $request, $id = 0) {
        $request->validate([
            'code' => 'required|string|max:40|unique:coupons,code,' . $id,
        ]);

        if ($id) {
            $coupons      = Coupons::findOrFail($id);
            $notification = 'Coupons updated successfully';
        } else {
            $coupons      = new Coupons();
            $notification = 'Coupons added successfully';
        }


        $coupons->name = $request->name;
        $coupons->code = $request->code;
        $coupons->start_date = $request->start_date;
        $coupons->end_date = $request->end_date;
        $coupons->max_use = $request->max_use;
        $coupons->type = $request->type;
        $coupons->value = $request->value;
        $coupons->status = $request->status;
        $coupons->unlimited_value_check = $request->unlimited_value_check;
        $coupons->description = $request->description;
        $coupons->save();
        // dd($coupons);

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function verifyCoupon(Request $request){
       $request->validate([
        'coupon' => 'required|string',
    ]);

        $coupon      = Coupons::where('code',$request->coupon)->first();

    if (!$coupon) {
        return response()->json(['status' => false, 'message' => 'Coupon not found.']);
    }

    // Check if coupon is inactive
    if ($coupon->status == 0) {
        return response()->json(['status' => false, 'message' => 'This coupon is inactive.']);
    }

    // Check if current date is before start date
    if (Carbon::now()->lt($coupon->start_date)) {
        return response()->json(['status' => false, 'message' => 'This coupon is not active yet.']);
    }

    // Check if current date is after end date
    if (Carbon::now()->gt($coupon->end_date)) {
        return response()->json(['status' => false, 'message' => 'This coupon has expired.']);
    }

    // Check if usage limit exceeded
    if ($coupon->use_count >= $coupon->max_use) {
        return response()->json(['status' => false, 'message' => 'This coupon has been used the maximum number of times.']);
    }

    return response()->json([
        'status' => true,
        'message' => 'Coupon is valid.',
        'type' => $coupon->type==0?'percentage':'period',
        'value' => $coupon->value,
        'unlimeted_value' => $coupon->unlimeted_value,
        'name' => $coupon->name,
    ]);


    }

}