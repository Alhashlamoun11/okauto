<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;

class CheckAccess
{
    public function handle(Request $request, Closure $next, $page)
    {
        $user = Auth::guard('admin')->user() ?? $request->user();
        // dd($user);
        if(!$user || (!in_array($page,json_decode($user->access,true)??[]))){
                        abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}