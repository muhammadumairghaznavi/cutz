<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    public $timestamps = false;

    public $fillable = ['title', 'short_description', 'description'];
}
