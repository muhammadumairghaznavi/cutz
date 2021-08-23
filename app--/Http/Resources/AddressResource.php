<?php

namespace App\Http\Resources;

use App\City;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{

    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'address' => $this->address,
            'frirstName' => $this->frirstName,
            'lastName' => $this->lastName,
            'phone' => $this->phone,
            'street' => $this->street,
            'city' => new CityResource(City::find($this->city_id)),
            'customer_region' => $this->customer_region,
            'home_number' => $this->home_number,
            'floor_number' => $this->floor_number,
            'postal_code' => $this->postal_code,
            'notes' => $this->notes,
            'status' => $this->status,


        ];
    }
}
