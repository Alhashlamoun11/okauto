<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\LogService;
use Illuminate\Support\Facades\Auth;

class LogRequests
{
    public function handle(Request $request, Closure $next)
    {
        // Proceed with the request
        $response = $next($request);
        
        // Log the action after the request is processed
        $user = Auth::guard('admin')->user() ?? $request->user();
        if($user){
        $action = $request->method() . ' ' . $request->path();
        $details = [
            'user_id' => $user->id,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'input' => $request->except(['password', '_token']), // Exclude sensitive data
            'status' => $response->getStatusCode(),
        ];
        if($request->method()!="GET")
            LogService::logAction($action, $details,$user->id);
        }
        return $response;
    }
}