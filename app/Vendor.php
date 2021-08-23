<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Vendor extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;


    use SoftDeletes;
    protected $guarded = [];


    public function getImagePathAttribute()
    {
        return asset('uploads/vendors/' . $this->image);
    } //end of image path attribute

}
