<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['title'];

    // many to many relationship  -- pivot table
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags', 'tag_id', 'product_id');
    } //end of products


    

}
