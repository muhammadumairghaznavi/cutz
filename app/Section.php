<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];
    public function category()
    {
        return $this->hasMany(Category::class);
    } //end of category
    public function products()
    {
        return $this->hasMany(Product::class);
    } //end of products

    public function getImagePathAttribute()
    {
        return asset('uploads/sections/' . $this->image);
    } //end of image path attribute
    public function getIconPathAttribute()
    {
        return asset('uploads/sections/' . $this->icon);
    } //end of image path attribute

    public function scopeSort($query)
    {
            return $query->orderBy('sort', 'asc');
    } //end of Sort
    
    



}//end of model
