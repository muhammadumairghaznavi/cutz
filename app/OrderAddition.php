<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddition extends Model
{

    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    } //end fo customer

    public function addition()
    {
        return $this->belongsTo(Addition::class);
    } //end of addition


}
