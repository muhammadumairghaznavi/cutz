<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartenersTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'short_description','description','seo_key','seo_description'];
  
}
