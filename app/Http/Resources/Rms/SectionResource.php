<?php

namespace App\Http\Resources\Rms;

use App\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            // 'image' => $this->image_path,
            // 'image2' => $this->icon_path,
            'title' => $this->title,
            //'short_description' => $this->short_description,
            //'description' => $this->description,
            'categories' => CategoryResource::collection(Category::where('section_id', $this->id)->get()),

        ];
    }

}
