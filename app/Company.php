<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'GSTTin', 'RegNo', 'address', 'island', 'city', 'telephone', 'fax', 'mobile', 'email', 'website', 'ownername', 'owneremail', 'ownermobile'];
    protected $dates = ['deleted_at'];
}
