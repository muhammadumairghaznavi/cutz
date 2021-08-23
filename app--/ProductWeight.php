<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end fo product


    public function weight()
    {
        return $this->belongsTo(Weight::class);
    } //end fo weight



}
