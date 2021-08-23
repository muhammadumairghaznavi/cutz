<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PieceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'short_description', 'description',];
}
