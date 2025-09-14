<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalExtraService extends Model
{
    protected $table = 'rental_extra_services';
    
    protected $fillable = [
        'rental_id',
        'extra_service_id',
        'quantity',
        'price',
    ];
    
    public function extraService()
    {
        return $this->belongsTo(ExtraService::class, 'extra_service_id');
    }
    
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}
