<?php

namespace App\Http\Resources;

use App\OrderDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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

            'total' => $this->total,
            'status' => $this->status,
            'shipping_number' => $this->shipping_number,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'customer_name' => $this->customer_name,
            'customer_address' => $this->customer_address,
            'customer_phone' => $this->customer_phone,
            'customer_email' => $this->customer_email,
            'customer_city' => $this->customer_city,
            'customer_country' => $this->customer_country,
            'customer_region' => $this->customer_region,
            'customer_street' => $this->customer_street,
            'customer_home_number' => $this->customer_home_number,
            'customer_floor_number' => $this->customer_floor_number,
            'customer_appartment_number' => $this->customer_appartment_number,
            'customer_postal_code' => $this->customer_postal_code,
            'customer_comments_extra' => $this->customer_comments_extra,
            'langtude' => $this->langtude,
            'lattude' => $this->lattude,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'taxes' => $this->taxes,
            'delivery_fees' => $this->delivery_fees,
            'promocode' => $this->promocode,
            'created_at' => $this->created_at,
            'order_detials' => OrderDetailsResource::collection(OrderDetail::where('order_id', $this->id)->get()),
        ];
    }
}
