<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description', 'extra_description',];
    public function getImagePathAttribute()
    {
        return asset('uploads/page/' . $this->image);
    } //end of image path attribute
    public function getFilePathAttribute()
    {
        return asset('uploads/page/' . $this->file);
    } //end of file path attribute





}
