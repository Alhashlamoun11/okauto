<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleExtraService extends Model
{
    protected $table = 'vehicle_extra_services';

    protected $fillable = [
        'vehicle_id',
        'extra_service_id',
        'custom_price',
        'active',
    ];

    public function extraService()
    {
        return $this->belongsTo(ExtraService::class, 'extra_service_id');
    }
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
