<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrivingS extends Model
{
    protected $guarded = [];

    protected $table = 'driving_s';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
