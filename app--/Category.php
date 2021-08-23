<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];

    public function section()
    {
        return $this->belongsTo(Section::class);
    } //end of section

    public function products()
    {
        return $this->hasMany(Product::class, 'subCategory_id');
    } //end of products
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    } //end of subCategory
    public function pieces()
    {
        return $this->hasMany(Piece::class);
    } //end of pieces

    public function scopeSort($query)
    {
            return $query->orderBy('sort', 'asc')->orderBy('created_at','desc');
    } //end of Sort



    public function getImagePathAttribute()
    {
        return asset('uploads/categories/' . $this->image);
    } //end of image path attribute

}//end of model
