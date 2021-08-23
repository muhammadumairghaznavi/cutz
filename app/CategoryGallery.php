<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryGallery extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];
    public function getImagePathAttribute()
    {
        return asset('uploads/galleries/' . $this->image);
    } //end of image path attribute

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    } //end fo galleries


}//end of model
