<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupSmsStatus extends Model
{
    protected $guarded = [];

    public function groupsms()
    {
        return $this->belongsTo('App\GroupSms', 'groupsms_id');
    }
}
