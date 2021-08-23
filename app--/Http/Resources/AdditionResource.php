<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdditionResource extends JsonResource
{

    public function toArray($request)
    {

        return [

            'id' => $this->id,
            'title' => $this->title_ar,
            'price' => $this->Total,
            'currency' => __('site.' . currncy()),
        ];
    }
}
