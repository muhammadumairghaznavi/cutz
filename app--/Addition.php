<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addition extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['title', 'description', 'short_description', 'seo_key', 'seo_description'];
    protected $appends = ['image_path'];

    public function CartDetail()
    {
        return $this->belongsTo(CartDetail::class);
    } //end fo cart


    public function getTotalAttribute()
    {
        $price = $this->price - $this->discount;
        return $price;
    } // end of Total attribute
    public function getTitleAttribute()
    {

        if (app()->getLocale() == 'ar') {
            $title = $this->title_ar;
        } else {
            $title = $this->title_en;
        }

        return $title;
    } // end of Total attribute



    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end fo product
    public function addtions()
    {
        return $this->hasMany(Addition::class);
    } //end fo addtions

}
