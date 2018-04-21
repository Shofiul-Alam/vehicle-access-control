<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'access_time',
        'vehicle_return',
        'vehicle_id',
        'driver_id',
    ];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }

}
