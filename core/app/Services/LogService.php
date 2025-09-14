<?php

namespace App\Services;

use App\Models\SystemLog;
use Illuminate\Support\Facades\Auth;

class LogService
{
    public static function logAction($action, $details = null, $userId = null)
    {
        $user = Auth::guard('admin')->user();
        if($user){
        
        $userId = $userId ?? $user->id?? 0; // Fallback to 0 for unauthenticated users
        $text = "[{$action}] " . ($details ? json_encode($details, JSON_UNESCAPED_UNICODE) : '');

        SystemLog::create([
            'user_id' => $userId,
            'text' => $text,
            'created_at' => now(),
        ]);
    }
    }
}