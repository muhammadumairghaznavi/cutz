<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Category;

class SectionResource extends JsonResource
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
            'image' => $this->image_path,
            'image2' => $this->icon_path,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'categories' => CategoryResource::collection(Category::where('section_id', $this->id)->get()),
        ];
    }
}
