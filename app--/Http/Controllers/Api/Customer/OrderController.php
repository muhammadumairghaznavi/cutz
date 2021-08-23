<?php

namespace App\Http\Controllers\Api\Customer;

use App\Cart;
use App\Rate;
use App\Order;
use App\State;
use App\Address;
use App\Product;
use App\Addition;

use App\Customer;

use App\Wishlist;
use App\PromoCode;
use App\CartDetail;
use App\OrderDetail;
use App\OrderAddition;
use App\ProductWeight;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Traits\AuthenticateUser;
use Laravel\Passport\HasApiTokens;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PromoResource;
use Illuminate\Support\Facades\Input;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CustomerResource;

use Illuminate\Notifications\Notifiable;
use App\Http\Resources\CartTotalResource;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    use AuthenticateUser;
    use ApiResponseTrait;
    use HasApiTokens, Notifiable;

    #favourit
    public function addTofavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $favoirte = Wishlist::firstOrCreate(['product_id' =>  $request->product_id, 'customer_id' => AuthCustomerApi()->id]);
        return $this->sendResponse("", "");
    } //end of addTofavourite

    public function deleteFavourite(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        Wishlist::where('product_id', $request->product_id)->where('customer_id',  AuthCustomerApi()->id)->delete();
        return $this->sendResponse("", "");
    } //end of deleteFavourite

    public function listDatafavourite(Request $request)
    {

        $products = Product::whereIn('id', $request->user()->wishlists->pluck('product_id'))->latest('id')->paginate(10);
        $items = ProductResource::collection($products);
        return $this->sendResponse($items, "");
    } //end of listDatafavourite


    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'productWeight_id' => 'sometimes|nullable|exists:product_weights,id',
            'qty' => 'required|integer|min:1',
            // 'type' => 'required|in:per_unit,gram',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $findCart = Cart::where('customer_id', AuthCustomerApi()->id)->where('product_id', $request->product_id)->where('productWeight_id', $request->productWeight_id)->first();
        if ($findCart) {
            return $this->sendResponse('Actually Added Successfuly', '');
        }


        //check stock
        $product = Product::find($request->product_id);
        if ($product->stock < $request->qty) {
            return $this->sendResponse('Not Allowed to add More than =' . $product->stock . 'Product', '');
        }
        if ($request->qty <= 0) {
            $request->qty = 1;
        }

        $cart = Cart::firstOrCreate([
            'customer_id' => AuthCustomerApi()->id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'productWeight_id' => $request->productWeight_id,
            // 'type' => $request->type,
        ]);

        if ($request->addition_id) {
            $this->CartDetail($cart->id, $request->addition_id, $request->qty);
        }
        return $this->sendResponse("Item Added Successfuly ", "");
    } //end of addToCart
    public function CartDetail($cart_id, $addition_id, $qty)
    {
        if ($addition_id) {
            $count_arry = explode(",", $addition_id);
            for ($i = 0; $i < count($count_arry); $i++) {
                $addtion = Addition::find($count_arry[$i]);
                if ($addtion) {

                    CartDetail::firstOrCreate([
                        'cart_id' => $cart_id,
                        'addition_id' => $count_arry[$i],
                        'qty' =>  $qty,
                    ]);
                } //end if
            } //end for
        } //end if
    }  //end of CartDetail

    public function deleteCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|exists:carts,id',

        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $cart = Cart::where('id', $request->cart_id);
        $cart->delete();
        return $this->sendResponse("", "");
    } //end of  deleteCart


    public function listDataCart(Request $request)
    {

        if (count(authCustomerApi()->carts) > 0) {

            return $this->sendResponse(new CartTotalResource(Customer::find(authCustomerApi())), "");
        } else {

            return $this->sendError(' ', 'cart is empty');
        }
    } //end of  listDataCart


    public function editCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        if ($request->qty <= 0) {
            $qty = 1;
        } else {
            $qty = $request->qty;
        }
        Cart::where('customer_id', authCustomerApi()->id)->where('id', $request->cart_id)->update([
            'qty' => $qty
        ]);
        CartDetail::where('cart_id', $request->cart_id)->update([
            'qty' => $qty
        ]);
        return $this->sendResponse("", "");
    } //end of  editCart

    public function addPromoCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|exists:promo_codes,code',

        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $promocode = PromoCode::where('code', $request->code)->whereDate('endDate', '>=', now()->toDateString())->first();
        return $this->sendResponse(new PromoResource($promocode), "");
    } //end of addPromoCode



    public function createOrder(Request $request)
    {

        if (count($this->GetCart()) <= 0) {
            return $this->sendError(' ', 'Cart Empty ');
        }

        $validator = Validator::make($request->all(), [
            'customer_phone' => 'required',
            'customer_name' => 'required',
            'device_type' => 'required|in:ios,android',
            'payment_method' => 'required|in:visa,cach',
            'city_id' => 'required|exists:cities,id',
            //'address_id' => 'required|exists:addresses,id',
            'state_id' => 'required|exists:states,id',

        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }

        $total_promoOrder = $this->promoOrder($request->code);
        $delivery_fees = $this->calcDeliveryFees($request->state_id);
        $total = $total_promoOrder + $delivery_fees;
        $address = Address::where('customer_id', authCustomerApi()->id)->latest()->first();

        $order =  Order::create([
            "customer_id" => authCustomerApi()->id,
            // will be changed to >>>>>> "address_id" => $address->id
            "address_id" => $address->id,
            // "customer_id" => $request->address??'',
            "total" => $total,
            "taxes" => 0,
            "delivery_fees" =>  $delivery_fees,
            "promocode" =>   $request->code,
            "device_type" =>   $request->device_type,

            "customer_name" => $request->customer_name,
            "customer_phone" => $request->customer_phone,
            "customer_email" => $request->customer_email,
            "customer_region" => $request->customer_region,
            "customer_street" => $request->customer_street,
            "customer_home_number" => $request->customer_home_number,
            "customer_floor_number" => $request->customer_floor_number,
            "customer_postal_code" => $request->customer_postal_code,
            "customer_comments_extra" => $request->customer_comments_extra,
            "payment_method" => $request->payment_method,
            "payment_status" => 'Not Complete',
        ]);

        $this->CreateOrderDetails($order->id);
        $this->CreateOrderAddtions($order->id);

        Cart::where('customer_id', authCustomerApi()->id)->delete();

        $order = Order::where('id', $order->id)->first();

        //call API RMS Integration
        createOrderRms($order->id);


        return $this->sendResponse(new OrderResource($order), "");


        //return $this->sendResponse("", "");
    } //end of createa orders

    public function GetCart()
    {
        return authCustomerApi()->carts;
    }
    public function CreateOrderDetails($order_id)
    {
        $carts = $this->GetCart();
        // $carts->cart_detials();
        foreach ($carts as $item) {

            if ($item->productWeight_id) {
                $productWeight = ProductWeight::find($item->productWeight_id);
                $type = $productWeight->weight->title;
            } else {
                $type = '';
            }

            OrderDetail::create([
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'type' => $type,
                'price_before_discount' => $item->product->total,
                'price' => $item->TotalCart,
            ]);

            $this->decrementStockProduct($item->product_id, $item->qty);
            $this->decrementStockProductWeight($item->productWeight_id, $item->qty);
        }
    } //end of CreateOrderDetails

    public function decrementStockProduct($product_id, $qty)
    {
        Product::where('id', $product_id)->decrement('stock', $qty);
    } //decrementStockProduct
    public function decrementStockProductWeight($productWeight_id, $qty)
    {
        ProductWeight::where('id', $productWeight_id)->decrement('stock', $qty);
    } //decrementStockProductWeight



    public function CreateOrderAddtions($order_id)
    {
        $carts = $this->GetCart();
        foreach ($carts as $item) {
            $cart_detials = $item->cart_detials;
            foreach ($cart_detials as $details) {
                OrderAddition::create([
                    'order_id' => $order_id,
                    'addition_id' => $details->addition_id,
                    'qty' => $details->qty,
                    'price' => $details->TotalCartDetails,
                    'price_before_discount' => $details->addtion->price,
                ]);
            }
        }
    } //end of CreateOrderAddtions
    public function update_payment_status(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $order = Order::where('id', $request->order_id)->update([
            "payment_status" => 'Complete',
        ]);


        return $this->sendResponse("", "");
    } //end of update_payment_status

    public function promoOrder($code)
    {
        if ($code) {
            $promocode = PromoCode::where('code', $code)->whereDate('endDate', '>=', now()->toDateString())->first();
            if ($promocode) {
                //totalWithPromo
                $total = round($promocode->subtotal(sum_cart(authCustomerApi()->id)));
            } else {
                $total = 0;
            }
        } else {
            $total = sum_cart(authCustomerApi()->id);
        }
        return $total;
    } //end of promoOrder

    public function calcDeliveryFees($state_id)
    {
        $state = State::find($state_id);
        if ($state) {

            $fees = $state->price;
        } else {
            $fees =  0;
        }
        return $fees;
    } //end of calcDeliveryFees

    public function listOrder()
    {
        $orders = Order::where('customer_id', authCustomerApi()->id)->paginate($this->PaginateNumber);
        $items = OrderResource::collection($orders);
        return $this->sendResponse($items, "");
    } //end of listOrder

    public function createRateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'rate' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $rate = Rate::firstOrCreate([
            'customer_id' => authCustomerApi()->id,
            'rate' => $request->rate,
            'feedback' => $request->feedback,
            'product_id' => $request->product_id,
        ]);
        return $this->sendResponse("", "");
    } //end of listOrder
}//end of class
