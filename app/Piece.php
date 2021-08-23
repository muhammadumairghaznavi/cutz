<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piece extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['title', 'short_description', 'description',];
    public function category()
    {
        return $this->belongsTo(Category::class);
    } //end of category



}
