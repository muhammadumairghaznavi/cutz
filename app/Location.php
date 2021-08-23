<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Location extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description', ];

    public function getImagePathAttribute()
    {
        return asset('uploads/location/' . $this->image);
    } //end of image path attribute


        public function scopeWhenLocation($query)
    {
        $latitude = request('lat');
        $longitude = request('lng');
        return $query->when(isset($latitude) && isset($longitude), function ($q) use ($latitude, $longitude) {
            return $q->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
            * cos(radians(lat)) * cos(radians(lng) - radians(" . $longitude . "))
            + sin(radians(" . $latitude . ")) * sin(radians(lat))) AS distance"))
            ->orderBy('distance', 'asc');
        });

    } // end of scopeWhenCategory

}
