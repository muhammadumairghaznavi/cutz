<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];

    public function getImagePathAttribute()
    {
        return asset('uploads/packages/' . $this->image);
    } //end of image path attribute

    public function order()
    {
        return $this->hasMany(Order::class);
    } //end of order
    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    } //end of invoice


    #egypt
    public function getScopePriceEgyMonthlyAttribute()
    {
        $price = $this->price_egy_monthly - $this->offer_egy_monthly;
        return $price;
    } // end of scope_price_egy_monthly
    public function getScopePriceEgyYearlyAttribute()
    {
        $price = $this->price_egy_yearly - $this->offer_egy_yearly;
        return $price;
    } // end of scope_price_egy_yearly

    #dollar
    public function getScopePriceDollarMonthlyAttribute()
    {
        $price = $this->price_dollar_monthly - $this->offer_dollar_monthly;
        return $price;
    } // end of scope_price_dollar_monthly
    public function getScopePriceDollarYearlyAttribute()
    {
        $price = $this->price_dollar_yearly - $this->offer_dollar_yearly;
        return $price;
    } // end of scope_price_dollar_yearly



    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }


    public function scopeMonthPrice($query)
    {
        return $query->OrWhere('price_egy_monthly', '!=', 0)->OrWhere('price_dollar_monthly', '!=', 0);
    }
    public function scopeYearPrice($query)
    {
        return $query->OrWhere('price_egy_yearly', '!=', 0)->OrWhere('price_dollar_yearly', '!=', 0);
    }
    ////
}
