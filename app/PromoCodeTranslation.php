<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCodeTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'short_description', 'description', 'extra_description'];
}
