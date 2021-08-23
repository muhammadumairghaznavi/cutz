<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function scopeNotActive($query)
    {
        return $query->where('status', 'notactive');
    }
}
