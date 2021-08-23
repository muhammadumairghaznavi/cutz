<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{



    protected $guarded = [];

    protected $fillable = [
        'user_id', 'review', 'comment', 'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeActive($query){
        return $query->where('status', 'active');
    }
}
