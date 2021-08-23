<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'description', 'short_description'];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('uploads/services/' . $this->image);
    } //end of image path attribute
    public function service_images()
    {
        return $this->hasMany(ImageService::class);
    } //end of service_images
    public function plans()
    {
        return $this->hasMany(Plan::class);
    } //end of plans
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    } //end of invoice
    public function order()
    {
        return $this->hasMany(Order::class);
    } //end of order


    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
