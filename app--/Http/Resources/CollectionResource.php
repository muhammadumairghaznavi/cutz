<?php

namespace App\Http\Resources;

use App\CollectionProduct;
use App\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //collections
        $CollectionProduct =   CollectionProduct::where('collection_id', $this->id)->pluck('product_id');
        return [

            'id' => $this->id,
            'section_id' => $this->section_id,
            'image' => $this->image_path,
            'title' => $this->title,
            'description' => $this->description,

            'products' => ProductResource::collection(Product::whereIn('id', $CollectionProduct)->get()),

        ];
    }
}
