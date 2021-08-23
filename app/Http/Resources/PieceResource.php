<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PieceResource extends JsonResource
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
            //  'image' => $this->image_path,
            //  'short_description' => $this->short_description,
            //  'description' => $this->description,


        ];
    }
}
