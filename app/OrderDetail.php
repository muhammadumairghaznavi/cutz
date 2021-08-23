<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    } //end fo customer.
    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end of products
}
