<?php

namespace App\Http\Controllers\FrontEndAuthentication\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\FrontendTrait;
use App\Wishlist;

class WishlistController extends Controller
{
    use FrontendTrait;
    public function addToWishlist($product_id)
    {
        Wishlist::firstOrCreate([
            'customer_id' => authCustomer()->id,
            'product_id' => $product_id,
        ]);
        session()->flash('success', __('site.added_successfuly'));
        return  redirect()->back();
    } //end of addToWishlist
    public function index()
    {
        $wishlists =  Wishlist::where('customer_id', authCustomer()->id)->latest()->paginate($this->PaginateNumber);
        return view('frontend.customer.profile.wishlists.index', compact('wishlists'));
    } //end of wishlists

    public function delete($id)
    {
        $Wishlist = Wishlist::find($id);

        $Wishlist->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return  redirect()->back();
    } //enf of delete
}
