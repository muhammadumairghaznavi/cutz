<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;

    public $fillable = ['title', 'short_description', 'description'];
} //end of model
