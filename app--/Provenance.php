<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provenance extends Model
{
    use \Dimsav\Translatable\Translatable;


    protected $guarded = [];

    public $translatedAttributes = ['title', 'description', 'short_description', 'seo_key', 'seo_description'];
    protected $appends = ['image_path'];



    public function getImagePathAttribute()
    {
        return asset('uploads/provenance/' . $this->image);
    } //end of image path attribute



}
