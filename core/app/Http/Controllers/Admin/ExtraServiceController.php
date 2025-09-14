<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ExtraService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\SystemLog;

class ExtraServiceController extends Controller
{
    public function index(){
        
        $pageTitle = 'All Extra Service';
        $services    = ExtraService::orderBy('id', 'desc')->paginate(getPaginate());
        
        return view('admin.extraServices.index',compact('services','pageTitle'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'default_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'active' => 'required|boolean',
        ]);
        
        ExtraService::create($request->only('name', 'default_price', 'description', 'active','is_per_day'));
        
        return back()->with('success', 'Service created successfully.');
    }
    
    public function update(Request $request, $id)
    {
        $service = ExtraService::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'default_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'active' => 'required|boolean',
        ]);
        
        $service->update($request->only('name', 'default_price', 'description', 'active','is_per_day'));
        
        return back()->with('success', 'Service updated successfully.');
    }
    

}