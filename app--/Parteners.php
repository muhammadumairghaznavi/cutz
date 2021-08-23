<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parteners extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['title', 'short_description', 'description', 'seo_key', 'seo_description'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/parteners/' . $this->image);
    } //end of image path attribute
}
