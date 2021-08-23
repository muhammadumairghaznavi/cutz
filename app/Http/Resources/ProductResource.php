<?php

namespace App\Http\Resources;

use App\Addition;
use App\Image;
use App\Instruction;
use App\Rate;
use App\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\ProvenanceCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{



    public function toArray($request)
    {

        $ProductInCart = 0;
        $IsProductFavoirte = 0;
        $ProductInCartQty = 0;
        if ($request->hasHeader('Authorization')) {
            if ($auth  =  auth()->guard('customer-api')->user()) {
                $IsProductFavoirte = (Wishlist::where('product_id', $this->id)->where('customer_id', $auth['id'])->first()) ? 1 : 0;
            }
        }
        $provenanceCategory = ProvenanceCategory::where('provenance_id', $this->provenance_id)->where('category_id', $this->category_id)->first();


        return [
            'id' => $this->id,
            'subCategory_id' => $this->subCategory_id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'frozenInstructions' => $this->frozenInstructions,
            'measr_unit' => $this->measr_unit,
            'MainPrice' => round($this->main, 2), //value  ($this->price - $this->discount)
            'discount' =>   $this->discount == null ? 0 : rand($this->discount, 2), //value db
            'FinalPrice' => round($this->Total, 2), //value  ($this->price - $this->discount)
            'stock' => $this->Total,
            'AvgRate' => $this->AvgRate,

            'country' => $this->provenance->title ?? "",
            'country_flag' => $this->provenance->image_path ?? "",
            'provenance_description' => $provenanceCategory->description_en ?? '',

            'stock' => $this->stock,
            'serve_number' => $this->serve_number,
            'BBQ' => $this->falg,
            'EliteProduct' => $this->IsElit,

            'panSearing' => $this->panSearing,
            'panSearing_img' => url('/') . '/frontend/assets/imgs/icons/panseearing.png',
            'chilled' => $this->chilies,
            'chilled_img' => url('/') . '/frontend/assets/imgs/icons/chilled.png',
            'frozen' => $this->frozen,
            'frozen_img' => url('/') . '/frontend/assets/imgs/icons/frozen.png',
            'frozenInstructions' => $this->frozenInstructions,
            'hermonFree' => $this->hermonFree,
            'chilled_img' => url('/') . '/frontend/assets/imgs/icons/healthy.png',

            'roasting' => $this->roasting,
            'roasting_img' => url('/') . '/frontend/assets/imgs/icons/roasting.png',
            'expiration' => $this->expiration,
            'IsFavoirte' => $IsProductFavoirte,
            'currency' => __('site.' . currncy()),
            'image' => $this->image_path,
            'images' => ImageProductResource::collection(Image::where('product_id', $this->id)->get()),
            'instructions' => InstructionResource::collection(Instruction::where('product_id', $this->id)->get()),
            'addtions' => AdditionResource::collection(Addition::where('product_id', $this->id)->get()),
            'rates' => RateResource::collection(Rate::where('product_id', $this->id)->get()),

            'weights' => ProductWeightResource::collection($this->productWeights),
            'nutritionFact' => $this->image_nutrition ?? "",




        ];
    }
}
