<?php
namespace App\Http\Controllers\Api\Rms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rms\ProductResource;
use App\Http\Resources\Rms\SectionResource;
use App\Http\Resources\Rms\SliderResource;
use App\Product;
use App\Section;
use App\Slider;
use App\Traits\ApiResponseTrait;
class RmsController extends Controller
{
    use ApiResponseTrait;
    public function sliders()
    {
        $sliders =SliderResource::collection(Slider::paginate($this->PaginateNumber));
        return $this->sendResponse($sliders, "");
    } //end of slider

    public function sections()
    {
        $sections = SectionResource::collection(Section::paginate($this->PaginateNumber));
        return $this->sendResponse($sections, "");
    } //end of sections


    public function products()
    {
        $products = ProductResource::collection(Product::paginate($this->PaginateNumber));
        return $this->sendResponse($products, "");
    } //end of products

    

}
