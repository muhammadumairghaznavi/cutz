<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use \Dimsav\Translatable\Translatable;


    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description',];


    public function city()
    {
        return $this->belongsTo(City::class);
    } //end of state

}
