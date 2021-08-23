<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Instruction extends Model
{

    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',    'extra_description', 'ingredient', 'seo_key',    'seo_description',];
    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end fo product
    public function getImagePathAttribute()
    {
        return asset('uploads/instructions/' . $this->image);
    } //end of image path attribute


}//end of model
