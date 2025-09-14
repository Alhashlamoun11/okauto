<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    protected $table = 'extra_services';

    protected $fillable = [
        'name',
        'description',
        'default_price',
        'is_per_day',
        'active',
    ];

    public function vehicleExtraServices()
    {
        return $this->hasMany(VehicleExtraService::class, 'extra_service_id');
    }

    public function rentalExtraServices()
    {
        return $this->hasMany(RentalExtraService::class, 'extra_service_id');
    }
}
