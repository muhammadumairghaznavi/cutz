<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageService extends Model
{
    protected $guarded = [];
    public  $timestamps = false;

    public function getImagePathAttribute()
    {
        return asset('uploads/services/' . $this->image);
    } //end of image path attribute

    public function service()
    {
        return $this->belongsTo(Service::class);
    } //end of service_images

}
