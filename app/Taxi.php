<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxi extends Model
{
    use SoftDeletes;
    protected $fillable = ['callcode_id', 'taxiNo', 'taxiChasisNo', 'taxiEngineNo', 'taxiBrand', 'taxiModel', 'taxiColor', 'taxiOwnerName', 'taxiOwnerMobile', 'taxiOwnerEmail', 'taxiOwnerAddress', 'registeredDate', 'anualFeeExpiry', 'roadWorthinessExpiry', 'insuranceExpiry', 'rate', 'taken', 'center_name'];
    protected $dates = ['deleted_at'];

    public function callcode()
    {
        return $this->belongsTo('App\CallCode', 'callcode_id');
    }  

    public function driver()
    {
        return $this->hasOne('App\Driver');
    }
    
    public function payment()
    {
        return $this->hasMany('App\paymentHistory');
    }

    public function payment_unpaid()
    {
        return $this->hasMany('App\paymentHistory')->where('paymentStatus', '0')->orderBy('created_at', 'asc');
    }
}
