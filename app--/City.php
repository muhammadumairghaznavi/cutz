<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];

    public function country()
    {
        return $this->belongsTo(Country::class);
    } //end of section

    public function states()
    {
        return $this->hasMany(State::class);
    } //end of cities.


}
