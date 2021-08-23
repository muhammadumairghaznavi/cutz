<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = [];
    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    } //end of image path attribute

    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end of product

}
