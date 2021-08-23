<?php

namespace App\Http\Resources;

use App\Addition;
use Illuminate\Http\Resources\Json\JsonResource;

class CartDetailsResource extends JsonResource
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
            'qty' => $this->qty,
            'price' => $this->TotalCartDetails,
            'addtions' => new AdditionResource(Addition::where('id', $this->addition_id)->first()),

        ];
    }
}
