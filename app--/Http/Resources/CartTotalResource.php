<?php

namespace App\Http\Resources;

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

        return [
            'total_cart' => sum_cart(authCustomerApi()->id),
            'cart_items' => CartResource::collection(authCustomerApi()->carts),
        ];
    }
}
