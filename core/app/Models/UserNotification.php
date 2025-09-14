<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    public $table="user_notifications";
    protected $fillable = ['user_id', 'title', 'body', 'is_read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

    
}
