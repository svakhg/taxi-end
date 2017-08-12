<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;
    protected $fillable = ['taxi_id', 'driverName', 'driverIdNo', 'driverTempAdd', 'driverPermAdd', 'driverMobile', 'driverEmail', 'driverLicenceNo', 'driverLicenceExp', 'driverPermitNo', 'driverPermitExp'];
    protected $dates = ['deleted_at'];

    public function taxi()
    {
        return $this->belongsTo('App\Taxi', 'taxi_id');
    }        
}
