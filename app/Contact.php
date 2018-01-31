<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function numbers()
    {
        return $this->hasMany('App\PhoneNumbers', 'contact_id');
    }
}
