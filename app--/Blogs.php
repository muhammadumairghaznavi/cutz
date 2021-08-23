<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blogs extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['title', 'description', 'short_description', 'seo_key', 'seo_description'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/blogs/' . $this->image);
    } //end of image path attribute


    public function scopeUsefulInformation($query)
    {
        return $query->where('type', 'useful_information');
    } //end of UsefulInformation

    public function scopeRecipes($query)
    {
        return $query->where('type', 'recipes');
    } //end of Recipes


}
