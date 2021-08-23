<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description'];
    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('uploads/plans/' . $this->image);
    } //end of image path attribute
    public function service()
    {
        return $this->belongsTo(Service::class);
    } //end of services

    public function getScopePriceEgyAttribute()
    {
        $price = $this->price_egy - $this->offer_egy;

        return $price;
    } // end of scope_price_egy  attribute



    public function getScopeEgyDiscountAttribute()
    {
        $price =  $this->offer_egy;
        return $price;
    } // end of scope_egy_discount  attribute

    public function getScopePriceUsdAttribute()
    {
        $price = $this->price_usd - $this->offer_usd;
        return $price;
    } // end of scope_price_usd attribute

    public function getScopeUsdDiscountAttribute()
    {
        $offer_usd =    $this->offer_usd;
        return $offer_usd;
    } // end of scope_usd_discount  attribute



}
