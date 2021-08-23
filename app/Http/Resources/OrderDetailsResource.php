<?php

namespace App\Http\Resources;

use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
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
            'id' => $this->id,
            'qty' =>   $this->qty,
            'price' => $this->price,
            'type' => $this->type,
            'product' => new ProductResource(Product::where('id', $this->product_id)->first()),



        ];
    }
}
