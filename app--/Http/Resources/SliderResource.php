<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
{
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'image' => $this->image_path,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,


        ];
    }
}
