<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

    protected $fillable = [
        'last_name',
        'license_no',
        'nfc_id',
        'user_id',
    ];

    public function accessLogs() {
        return $this->hasMany(AccessLog::class);
    }

    public function token() {
        return $this->hasOne(AccessToken::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
