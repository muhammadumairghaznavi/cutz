<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    protected $guarded = [];
    
    protected $fillable = [
        'weight_id', 'product_id', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end fo product


    public function weight()
    {
        return $this->belongsTo(Weight::class);
    } //end fo weight
    
    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function weights(){
        return $this->belongsToMany(Weight::class);
    }



}
