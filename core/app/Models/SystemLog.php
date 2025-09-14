<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
class SystemLog extends Model
{
    protected $table = 'system_logs'; // Or 'notes' if using existing table
    protected $fillable = ['user_id', 'text', 'created_at'];

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }
}