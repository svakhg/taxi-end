<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class paymentHistory extends Model
{
    use SoftDeletes;
    protected $fillable = ['taxi_id', 'month', 'year', 'qty', 'total', 'subtotal', 'gstAmount', 'totalAmount', 'slipNo', 'desc', 'user_id', 'paymentStatus'];

    public function taxi()
    {
        return $this->belongsTo('App\Taxi', 'taxi_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
}
