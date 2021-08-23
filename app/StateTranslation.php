<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StateTranslation extends Model
{

    public $timestamps = false;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];

} //end of model
