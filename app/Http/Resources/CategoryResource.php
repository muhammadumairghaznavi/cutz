<?php

namespace App\Http\Resources;

use App\Piece;
use Illuminate\Http\Resources\Json\JsonResource;
use App\SubCategory;

class CategoryResource extends JsonResource
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
            'section_id' => $this->section_id,
            'image' => $this->image_path,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'sub_categories' => SubCategoryResource::collection(SubCategory::where('category_id', $this->id)->get()),
            'parts' => PieceResource::collection(Piece::where('category_id', $this->id)->get()),

        ];
    }
}
