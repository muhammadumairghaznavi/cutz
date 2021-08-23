<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    public $timestamps = false;
    public $fillable = ['title', 'short_description', 'description', 'extra_description'];
}
