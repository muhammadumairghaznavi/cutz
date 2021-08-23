<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoResource extends JsonResource
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
            'code' => $this->code,
            'total' => sum_cart(authCustomerApi()->id),
            'discount' => round($this->discount(sum_cart(authCustomerApi()->id))),
            'totalWithPromo' => round($this->subtotal(sum_cart(authCustomerApi()->id))),
            // 'totalWithPromo' => $this->subtotal(sum_cart(authCustomerApi()->id)),
        ];
    }
}
