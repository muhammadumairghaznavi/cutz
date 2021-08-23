<?php

namespace App\Http\Resources;

use App\Piece;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Product;

class SubCategoryResource extends JsonResource
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
            'category_id' => $this->category_id,
            'image' => $this->image_path,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
        ];
    }
}
