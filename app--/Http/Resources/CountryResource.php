<?php

namespace App\Http\Resources;

use App\City;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'title' => $this->title,
            'city' =>CityResource::collection(City::where('country_id', $this->id)->get()),
        ];
    }
}
