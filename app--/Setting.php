<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = [
        'working_hours',
        'address',
        'seo_title',
        'seo_key',
        'seo_des',
        'title'
    ];
    protected $appends = ['image_path', 'footer_logo', 'icon'];
    public function getImageLogoAttribute()
    {
        return asset('uploads/setting/' . $this->logo);
    } //end of image path attribute
    public function getImageIconAttribute()
    {
        return asset('uploads/setting/' . $this->icon);
    } //end of image path attribute
    public function getImageFooterAttribute()
    {
        return asset('uploads/setting/' . $this->footer_logo);
    } //end of image path attribute
}
