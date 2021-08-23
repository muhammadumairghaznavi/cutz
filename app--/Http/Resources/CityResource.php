<?php

namespace App\Http\Resources;

use App\State;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'state' => StatesResource::collection(State::where('city_id', $this->id)->get()),

        ];
    }
}
