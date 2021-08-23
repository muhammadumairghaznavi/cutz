<?php

namespace App\Http\Resources;

use App\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
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
            'rate' => $this->rate,
            'feedback' => $this->feedback,
            'customer' => new CustomerResource(Customer::where('id', $this->customer->id)->first()),
        ];
    }
}
