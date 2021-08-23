<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'short_description', 'seo_key', 'seo_description'];
}
