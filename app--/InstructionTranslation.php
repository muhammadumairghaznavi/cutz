<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructionTranslation extends Model
{
    public $timestamps = false;

    public $fillable = ['title', 'short_description', 'description',    'extra_description', 'ingredient', 'seo_key',    'seo_description'];
} //end of model
