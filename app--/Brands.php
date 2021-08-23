<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
      protected $guarded = [];
      protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/brand/' . $this->image);
    }//end of image path attribute
    
}
