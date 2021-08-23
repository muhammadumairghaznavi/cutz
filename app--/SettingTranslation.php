<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'working_hours',
        'address',
        'seo_title',
        'seo_key',
        'seo_des',
        'title'
    ];
}
