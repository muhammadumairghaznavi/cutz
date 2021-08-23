<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    // use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    } //end of image path attribute

    public function products()
    {
        return $this->belongsToMany(Product::class, 'collection_products', 'collection_id');
    } //end of prroducts 


}//end of model
