<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];


    public function cities()
    {
        return $this->hasMany(City::class);
    } //end of cities.

}
