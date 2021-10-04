<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['title', 'short_description', 'description', 'extra_description', 'frozenInstructions'];
    protected $appends = ['image_path', 'image_nutrition', 'image_flag', 'icon_path', 'profit_percent'];
    // protected $hidden = ['pivot'];
    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    } //end of image path attribute
    public function getFlagPathAttribute()
    {
        return asset('uploads/product_images/' . $this->image_flag);
    } //end of image flag_path attribute
    public function getIconPathAttribute()
    {
        return asset('uploads/product_images/' . $this->image2);
    } //end of icon_path path attribute
    public function getImageNutritionAttribute()
    {
        return asset('uploads/product_images/' . $this->nutritionFact);
    } //end of ImagNutritionFact path attribute




    public function rates()
    {
        return $this->hasMany(Rate::class);
    } //end of rates
    public function productLocation()
    {
        return $this->hasMany(ProductLocation::class, 'product_id');
    } //end of productLocation

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    } //end fo wishlist

    public function provenance()
    {
        return $this->belongsTo(Provenance::class);
    } //end fo provenance

    public function section()
    {
        return $this->belongsTo(Section::class);
    } //end fo section

    public function category()
    {
        return $this->belongsTo(Category::class);
    } //end fo category
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subCategory_id');
    } //end fo subCategory

    public function instructions()
    {
        return $this->hasMany(Instruction::class);
    } //end of instructions
    public function additions()
    {
        return $this->hasMany(Addition::class);
    } //end of additions

    public function productWeights()
    {
        return $this->hasMany(ProductWeight::class);
    } //end fo productWeights

    public function weights(){
        return $this->belongsToMany(Weight::class, 'product_weights', 'product_id', 'weight_id')->withPivot('price')->withTimestamps();
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_products', 'product_id');
    } //end of collections

    public function images()
    {
        return $this->hasMany(Image::class);
    } //end fo images

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'tag_id', 'product_id');
    } //end of tags  many to many relationship  -- pivot table

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    } //end fo invoice
    public function order()
    {
        return $this->belongsTo(Order::class);
    } //end fo order



    public function getTotalAttribute()
    {
        $price = $this->price;

        if ($this->measr_unit == 'per_unit') {
            $price = $price * $this->unitValue;
        }

        return $price;
    } // end of Total attribute



    public function getAvgRateAttribute()
    {
        $total =  round($this->rates->avg('rate'));

        return $total;
    } // end of AvgRate attribute


    public function getMainPriceAttribute()
    {

        $price = $this->price;
        return $price;
    } // end of MainPrice attribute



    public function getStockStatusAttribute()
    {
        $count = $this->stock;
        if ($count == 0) {
            $message = "OutOfStock";
        } elseif ($count <= 5 && $count > 0) {
            $message = "LimitedOfStock";
        } else {
            $message = "AvailableOfStock";
        }
        return $message;
    } // end of stock_status attribute
    public function getIsElitAttribute()
    {
        $item = $this->spicail_pag;
        if ($item == 'active') {
            $message = "yes";
        } else {
            $message = "no";
        }
        return $message;
    } // end of IsElit attribute



    public function getStockCountAttribute()
    {
        $count = $this->stock;

        return $count;
    } // end of stock_count attribute

    public function scopeInStock($query)
    {
        return $query->whereRaw('stock>0');
    } //end of InStock


    public function scopeStockAvailable($query)
    {
        return $query->whereRaw('stock >= 5');
    } //end of scope
    public function scopeStockLimited($query)
    {
        return $query->whereRaw('stock < 5')->whereRaw('stock> 0');
    } //end of scope
    public function scopeStockOff($query)
    {
        return $query->whereRaw('stock<= 0');
    } //end of scope



    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    } //end of scope


    public function scopeHome($query)
    {
        return $query->where('home_page', 'yes');
    } //end of scope
    public function scopeElite($query)
    {
        return $query->where('spicail_pag', 'active');
    } //end of scope
    public function scopeNotElite($query)
    {
        return $query->where('spicail_pag', 'not_active');
    } //end of scope
    public function scopeBestSeller($query)
    {
        return $query->where('best_seller', 'active');
    } //end of scopeBestSeller
    public function scopeBBQ($query)
    {
        return $query->where('falg', 'yes');
    } //end of scope


    public function scopeHasOffer($query)
    {
        return $query->whereRaw('discount> 0');
    } //end of scope






}//end of model
