<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    } //end fo customer


}
