<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    protected $fillable = [
        'token',
        'driver_id',
    ];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
