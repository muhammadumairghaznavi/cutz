<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];
    public function getImagePathAttribute()
    {
        return asset('uploads/galleries/' . $this->image);
    } //end of image path attribute

    public function CategoryGallery()
    {
        return $this->belongsTo(CategoryGallery::class, 'category_gallery_id');
    } //end of CategoryGallery





}//end of model
