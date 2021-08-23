<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(Product::class);
    } //end of products

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } //end fo customer

    public function orderAddtions()
    {
        return $this->hasMany(OrderAddition::class);
    } //end of products


    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    } //end of products


}
