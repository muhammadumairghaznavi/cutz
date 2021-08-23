<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];

    public function products()
    {
        return $this->hasMany(Product::class, 'subCategory_id');
    } //end of products
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            "name"=>'',
            ]);
    } //end fo category

    public function getImagePathAttribute()
    {
        return asset('uploads/subCategories/' . $this->image);
    } //end of image path attribute
}//end of model
