<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];
    public function cart_detials()
    {
        return $this->hasMany(CartDetail::class);
    } //end of cart_detials

    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end fo category
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } //end of customer
    public function productWeight()
    {
        return $this->belongsTo(ProductWeight::class, 'productWeight_id');
    } //end of productWeight


    public function getTotalCartAttribute()
    {
         $price = $this->type?$this->product->Total *$this->qty*(int)($this->type) /1000: $this->product->Total * $this->qty;

        // $price = $this->product->total *  $this->qty;
        if ($this->productWeight_id) {
            $productWeight = ProductWeight::find($this->productWeight_id);
            $price = $productWeight->price *  $this->qty;
        }


        if ($this->type == 'gram') {
            $price = $this->product->total / 2 *  $this->qty;
        }





        return $price;
    } // end of TotalCart attribute


    public function getSumCartDetailsAttribute()
    {
        $price = $this->cart_detials->sum('TotalCartDetails');
        return $price;
    } // end of SumCartDetails attribute

    public function getSumCartWithCartDetailsAttribute()
    {
        $price = $this->cart_detials->sum('TotalCartDetails') + $this->getTotalCartAttribute();
        return $price;
    } // end of SumCartWithCartDetails attribute

















}
