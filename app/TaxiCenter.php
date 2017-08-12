<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxiCenter extends Model
{
    use SoftDeletes;
    protected $fillable = ['company_id', 'name', 'cCode', 'address', 'telephone', 'mobile', 'email', 'fax'];
    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function callcode()
    {
        return $this->hasMany('App\CallCode');
    }
}
