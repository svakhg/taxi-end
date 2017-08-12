<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCode extends Model
{
    use SoftDeletes;
    protected $fillable = ['center_id', 'callCode'];
    protected $dates = ['deleted_at'];

    public function taxicenter()
    {
        return $this->belongsTo('App\TaxiCenter', 'center_id');
    }

    public function callcode()
    {
        return $this->hasOne('App\CallCode');
    }
}
