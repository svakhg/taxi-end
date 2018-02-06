<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSms extends Model
{
    protected $guarded = [];

    public function numbers()
    {
        return $this->hasMany('App\GroupSmsStatus', 'groupsms_id');
    }
}
