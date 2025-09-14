<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\SystemLog;

class EmployeeController extends Controller
{
    public function index(){
        
        $pageTitle = 'All Employee';
        $employees    = Admin::searchable(['name'])->orderBy('id', 'desc')->paginate(getPaginate());

        
        return view('admin.employee.index',compact('employees','pageTitle'));
    }
    
        public function store(Request $request, $id = 0) {
        $request->validate([
            'name' => 'required|string|max:40|unique:admins,name,' . $id,
            'email' => 'required|string|max:40|unique:admins,email,' . $id,
            'username' => 'required|string|max:40|unique:admins,username,' . $id,
        ]);
        
        // dd($request->post());

        if ($id) {
            $employee      = Admin::findOrFail($id);
            $notification = 'Employee updated successfully';
        } else {
            $employee      = new Admin();
            $notification = 'Employee added successfully';
        }
        
        $access = [];
        
        if (isset($request->vehcile)) {
            $access[] = 1;
        }
        if (isset($request->extra_services)) {
            $access[] = 19;
        }
        
        if (isset($request->dashboard)) {
            $access[] = 0;
        }
        if (isset($request->coupons)) {
            $access[] = 17;
        }
        
        if (isset($request->notifications)) {
            $access[] = 15;
        }

        if (isset($request->reports)) {
            $access[] = 14;
        }
        
        if (isset($request->reports)) {
            $access[] = 11;
        }
        
        if (isset($request->system_settings)) {
            $access[] = 13;
        }
        
        if (isset($request->subscibers)) {
            $access[] = 12;
        }
        
        if (isset($request->support)) {
            $access[] = 10;
        }
        
        if (isset($request->withdraw)) {
            $access[] = 9;
        }
        
        if (isset($request->payments)) {
            $access[] = 8;
        }
        if (isset($request->users)) {
            $access[] = 7;
        }
        if (isset($request->manage_rentals)) {
            $access[] = 6;
        }
        
        if (isset($request->manage_vehcile)) {
            $access[] = 5;
        }
        
        if (isset($request->stores)) {
            $access[] = 4;
        }
        
        if (isset($request->employees)) {
            $access[] = 3;
        }
        
        if (isset($request->zones)) {
            $access[] = 2;
        }
        
        if (isset($request->brands)) {
            $access[] = 16;
        }
        
        if (isset($request->general_setting)) {
            $access[] = 18;
        }
        
        if (isset($request->logo_favicon)) {
            $access[] = 19;
        }
        
        if (isset($request->system_configuration)) {
            $access[] = 20;
        }
        
        if (isset($request->notification_setting)) {
            $access[] = 21;
        }
        
        if (isset($request->payment_gateways)) {
            $access[] = 22;
        }
        
        if (isset($request->withdrawal_methods)) {
            $access[] = 23;
        }
        
        if (isset($request->seo_configuration)) {
            $access[] = 24;
        }
        
        if (isset($request->manage_frontend)) {
            $access[] = 25;
        }
        
        if (isset($request->manage_pages)) {
            $access[] = 26;
        }
        
        if (isset($request->kyc_setting)) {
            $access[] = 27;
        }
        
        if (isset($request->store_kyc_setting)) {
            $access[] = 28;
        }
        
        if (isset($request->social_login_setting)) {
            $access[] = 29;
        }
        
        if (isset($request->language)) {
            $access[] = 30;
        }
        
        if (isset($request->extensions)) {
            $access[] = 31;
        }
        
        if (isset($request->policy_pages)) {
            $access[] = 32;
        }
        
        if (isset($request->maintenance_mode)) {
            $access[] = 33;
        }
        
        if (isset($request->gdpr_cookie)) {
            $access[] = 34;
        }
        
        if (isset($request->custom_css)) {
            $access[] = 35;
        }
        
        if (isset($request->sitemap_xml)) {
            $access[] = 36;
        }
        
        if (isset($request->robots_txt)) {
            $access[] = 37;
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        if($request->password != '' && $request->password!=null){
        $employee->password = Hash::make($request->password);
            
        }
        $employee->username = $request->username;
        $employee->access = json_encode($access);
        $employee->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

    public function employee_logs(){
        $logs=SystemLog::orderBy('id','desc')->with('user')->paginate(getPaginate());
        $pageTitle="Logs";
        return view('admin.employee_logs.index',compact('pageTitle','logs'));
    }
    

}