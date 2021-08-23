<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\Customer\OrderController;
use Illuminate\Http\Resources\Json\JsonResource;

class CartTotalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total_cart = (new OrderController())->sum_Incart();
        return [
            // 'total_cart' => sum_cart(authCustomerApi()->id),
            'total_cart' =>  number_format($total_cart, 2, '.', ''),
            'cart_items' => CartResource::collection(authCustomerApi()->carts),
        ];
    }
}
