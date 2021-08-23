<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $guarded = [];




    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end fo category



    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } //end of customer


}
