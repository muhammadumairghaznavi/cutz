<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeightTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'short_description'];
}
