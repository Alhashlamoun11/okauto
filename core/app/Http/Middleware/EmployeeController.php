<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        ]);
        
        dd($request->post());

        if ($id) {
            $employee      = Admin::findOrFail($id);
            $notification = 'Employee updated successfully';
        } else {
            $employee      = new Admin();
            $notification = 'Employee added successfully';
        }
        
        $access=[];
        if(isset($request->vehcile))
            $access[]=1;

        if(isset($request->notifications))
            $access[]=2;
        if(isset($request->reports))
            $access[]=3;
        if(isset($request->system_settings))
            $access[]=4;
        if(isset($request->subscibers))
            $access[]=5;
        if(isset($request->reports))
            $access[]=6;
        if(isset($request->support))
            $access[]=7;
        if(isset($request->withdraw))
            $access[]=8;
        if(isset($request->payments))
            $access[]=9;
            
        if(isset($request->users))
            $access[]=10;
        if(isset($request->manage_rentals))
            $access[]=11;
        if(isset($request->manage_vehcile))
            $access[]=12;
            
        if(isset($request->stores))
            $access[]=13;
        if(isset($request->employees))
            $access[]=14;

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->username = $request->username;
        $employee->access = json_encode($access);
        $employee->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }


}