<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimonails extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'description', 'short_description'];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('uploads/testimonails/' . $this->image);
    } //end of image path attribute

}
