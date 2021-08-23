<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $guarded = [];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    } //end fo cart

    public function addtion()
    {
        return $this->belongsTo(Addition::class, 'addition_id');
    } //end fo addtions


    public function getTotalCartDetailsAttribute()
    {
        $price = $this->addtion->price *  $this->qty;
        return $price;
    } // end of TotalCartDetails attribute



}
