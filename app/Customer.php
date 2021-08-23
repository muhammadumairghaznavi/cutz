<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class Customer   extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    use SoftDeletes;

    use  HasApiTokens;


    protected $guarded = [];
    public function orders()
    {
        return $this->hasMany(Order::class);
    } //end of orders
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    } //end of wishlists


    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    } //end of invoices

    public function rates()
    {
        return $this->hasMany(Rate::class);
    } //end of rates
    public function carts()
    {
        return $this->hasMany(Cart::class);
    } //end of carts


    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class, 'customer_id');
    } //end of invoice_details

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    } //end of tickets
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('uploads/customers/' . $this->image);
    } //end of image path attribute

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
