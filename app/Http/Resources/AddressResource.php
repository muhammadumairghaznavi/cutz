<?php

namespace App\Http\Resources;

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
            'home_number' => $this->home_number,
            'floor_number' => $this->floor_number,
            'postal_code' => $this->postal_code,
            'notes' => $this->notes,
            'status' => $this->status,
            'city' => new CityResource($this->city),
        ];
    }
}
