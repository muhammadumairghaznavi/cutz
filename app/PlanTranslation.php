<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'short_description', 'description'];
}
