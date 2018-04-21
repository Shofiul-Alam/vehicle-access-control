<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'brand_name',
        'model',
        'registration_no',
    ];

    public function accessLogs() {
        return $this->hasMany(AccessLog::class);
    }
}
