<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'name' => $this->full_name,
            'email' => $this->email,
            'image' => $this->image_path,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'customer_address' => $this->customer_address,
            'customer_region' => $this->customer_region,
            'customer_street' => $this->customer_street,
            'customer_home_number' => $this->customer_home_number,
            'customer_floor_number' => $this->customer_floor_number,
            'customer_appartment_number' => $this->customer_appartment_number,
            'customer_postal_code' => $this->customer_postal_code,
            'customer_notes' => $this->customer_comments_extra,
            'created_at' => $this->created_at,


        ];
    }
}
