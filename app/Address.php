<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/address/' . $this->image);
    } //end of image path attribute

    public function city()
    {
        return $this->belongsTo(City::class);
    } //end fo provenance

}
