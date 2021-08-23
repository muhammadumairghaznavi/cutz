<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'description', 'short_description'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/weight/' . $this->image);
    } //end of get image path

    public function productWeights()
    {
        return $this->hasMany(ProductWeight::class);
    } //end fo productWeights
 



}
