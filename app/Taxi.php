<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxi extends Model
{
    use SoftDeletes;
    protected $fillable = ['callcode_id', 'taxiNo', 'taxiChasisNo', 'taxiEngineNo', 'taxiBrand', 'taxiModel', 'taxiColor', 'taxiOwnerName', 'taxiOwnerMobile', 'taxiOwnerEmail', 'taxiOwnerAddress', 'registeredDate', 'anualFeeExpiry', 'roadWorthinessExpiry', 'insuranceExpiry', 'rate'];
    protected $dates = ['deleted_at'];

    public function callcode()
    {
        return $this->belongsTo('App\CallCode', 'callcode_id');
    }  

    public function driver()
    {
        return $this->hasOne('App\Driver');
    }  
}
