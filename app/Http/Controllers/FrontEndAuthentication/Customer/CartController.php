<?php

namespace App\Http\Controllers\FrontEndAuthentication\Customer;

use App\Cart;
use App\CartDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\FrontendTrait;
use Illuminate\Support\Facades\Input;

class CartController extends Controller
{
    use FrontendTrait;
    public function index()
    {
           $carts = Cart::where('customer_id', authCustomer()->id)->latest()->paginate($this->PaginateNumber);
        return view('frontend.customer.profile.carts.index', compact('carts'));
    }
    public function create(Request $request)
    {
        if ($request->cart) {
            $cart_products =  json_decode($request->cart,true);
            foreach ($cart_products as $product) {
                Cart::find($product['id'])->update(['qty' => $product['qty']]);
            }
            session()->flash('success', ['ar' => 'تم تحديث السلة بنجاح ','en' => 'Cart Updated Successfully'][app()->getLocale()]);
            return  redirect()->back();
        }

        $request_data = $request->except(['addition_id', 'productWeight_id']);

            // $findCart = Cart::where('customer_id', authCustomer()->id)->where('product_id', $request->product_id)->where('productWeight_id', $request->productWeight_id)->first();
        $findCart = Cart::where('customer_id', authCustomer()->id)->where('product_id', $request->product_id)->when($request->type, function ($q) use ($request) {
            return $q->where('type',$request->type);
        })->first();

        if ($findCart ) {

            $findCart->update(['qty' => $request->qty]);
            // session()->flash('success', __('site.actually_added_successfuly'));
            session()->flash('success', ['ar' => 'تم تحديث السلة بنجاح ','en' => 'Cart Updated Successfully'][app()->getLocale()]);
            return  redirect()->back();
        }

        //check stock
        $product = Product::find($request->product_id);
        if ($product->stock < $request->qty) {
            session()->flash('success', __('Not Allowed to add More than =' . $product->stock . 'Product'));
            return  redirect()->back();
        }
        //dd($request->type);


        if ($request->qty <= 0) {
            $request->qty = 1;
        }

        $cart = Cart::firstOrCreate([
            'customer_id' => authCustomer()->id,
            'product_id' => $request->product_id,
            'productWeight_id' => $request->productWeight_id,
            'type' => null,
            'qty' => $request->qty,
        ]);
        if ($request->addition_id) {
            $this->CartDetail($cart->id, $request->addition_id, $request->qty);
        }
        session()->flash('success', __('site.added_successfuly'));
        return  redirect()->back();
    }

    public function CartDetail($cart_id, $addition_id, $qty)
    {
        if ($addition_id) {
            $input = Input::all();
            //  dd($input);
            foreach ($input['addition_id'] as $index => $value) {
                CartDetail::firstOrCreate([
                    'cart_id' => $cart_id,
                    'addition_id' => $input['addition_id'][$index],
                    'qty' =>  $qty,

                ]);
            }
        }
    }
    public function delete($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return  redirect()->back();
    } //enf of delete
}
