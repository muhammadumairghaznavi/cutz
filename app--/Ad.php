<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;

    protected $guarded = [];

    public $translatedAttributes = ['title', 'description', 'short_description', 'seo_key', 'seo_description'];
    protected $appends = ['image_path'];



    public function getImagePathAttribute()
    {
        return asset('uploads/ad/' . $this->image);
    } //end of image path attribute
}
