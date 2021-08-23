<?php

namespace App\Http\Controllers\Api\General;

use App\About;
use App\Blogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ImageProductResource;
use App\Http\Resources\AdditionResource;
use App\Http\Resources\CollectionResource;
use App\Section;
use App\Category;
use App\Collection;
use App\Country;
use App\Http\Resources\AboutResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\TagsResource;
use App\Inbox;
use App\Location;
use App\Page;
use App\Piece;
use App\SubCategory;
use App\Product;
use App\ProductLocation;
use App\ProductPiece;
use App\ProductTag;
use App\Slider;
use App\Tag;
use App\Traits\ApiResponseTrait;

use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    use ApiResponseTrait;

    public function nearstBranch(Request $request)
    {
        $location = Location::WhenLocation()->first();
        return $this->sendResponse(new LocationResource($location, ""));
    } //end of nearstBranch

    public function listBranches()
    {
        $locations = LocationResource::collection(Location::paginate($this->PaginateNumber));
        return $this->sendResponse($locations, "");
    } //end of listBranches
    public function productLocation(Request $request)
    {

        $location = Location::WhenLocation()->first();
        $list_products = ProductLocation::where('location_id', $location->id)->pluck('product_id');
        // dd($list_products);
        return $list_products;
    } //end of productLocation


    public function sliders()
    {
        // $sliders = Slider::first();
        // return $this->sendResponse(new SliderResource($sliders), "");
        $sliders = SliderResource::collection(Slider::paginate($this->PaginateNumber));
        return $this->sendResponse($sliders, "");
    } //end of slider
    public function about()
    {
        $items = AboutResource::collection(About::paginate($this->PaginateNumber));
        return $this->sendResponse($items, "");
    } //end of about
    public function pages()
    {
        $items = PageResource::collection(Page::paginate($this->PaginateNumber));
        return $this->sendResponse($items, "");
    } //end of pages




    public function blogs()
    {
        $items = BlogResource::collection(Blogs::paginate($this->PaginateNumber));
        return $this->sendResponse($items, "");
    } //end of blogs


    public function sections()
    {
        $items = SectionResource::collection(Section::Sort()->get());
        return $this->sendResponse($items, "");
    } //end of sections
    public function categories(Request $request)
    {
        // $items = CategoryResource::collection(Category::where('section_id', $request->id_section)->get());
        $items = CategoryResource::collection(Category::Sort()->get());
        return $this->sendResponse($items, "");
    } //end of categories
    public function sub_categories(Request $request)
    {
        $items = SubCategoryResource::collection(SubCategory::where('category_id', $request->category_id)->get());
        return $this->sendResponse($items, "");
    } //end of sub_categories
    public function products(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'lat' => 'required',
            // 'lng' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }


        if ($request->piece_id) {

            $product_id = ProductPiece::where('piece_id', $request->piece_id)->pluck('product_id');
            $products = Product::WhereIn('id', $product_id)->InStock()->Active()->paginate($this->PaginateNumber);
            //     dd(count($products));
        }

        if ($request->subCategory_id) {

            $products = Product::
            // whereIn('id', $this->productLocation($request))->
            where('subCategory_id', $request->subCategory_id)->InStock()->Active()->paginate($this->PaginateNumber);
        }


        if ($request->section_id) {


            $products = Product::whereIn('id', $this->productLocation($request))->where('section_id', $request->section_id)->InStock()->Active()->paginate($this->PaginateNumber);
        }

        $items = ProductResource::collection($products);
        return $this->sendResponse($items, "");
    } //end of products



    public function relatedProduct(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'lat' => 'required',
            'lng' => 'required',

        ]);


        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $product = Product::find($request->product_id);
        $products = Product::whereIn('id', $this->productLocation($request))->where('category_id', $product->category_id)->where('id', '!=', $product->id)->InStock()->Active()->paginate($this->PaginateNumber);

        $items = ProductResource::collection($products);
        return $this->sendResponse($items, "");
    } //end of relatedProduct

    public function offers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }

        $products = Product::whereIn('id', $this->productLocation($request))->HasOffer()->InStock()->Active()->paginate($this->PaginateNumber);
        $items = ProductResource::collection($products);
        return $this->sendResponse($items, "");
    } //end of offers


    public function bestSeller()
    {
        $products = Product::BestSeller()->InStock()->Active()->paginate($this->PaginateNumber);
        $items = ProductResource::collection($products);
        return $this->sendResponse($items, "");
    } //end of bestSeller



    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'key' => 'required',
            // 'lat' => 'required',
            // 'lng' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $products = Product::whereIn('id', $this->productLocation($request))->when($request->key, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->key . '%');
        })->InStock()->Active()->paginate($this->PaginateNumber);
        $items = ProductResource::collection($products);
        return $this->sendResponse($items, "");
    } //end of search

    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'subCategory_arr' => 'required',
            //'tag_arr' => 'required',
            'lat' => 'required',
            'lng' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }

        $tag_arr = explode(",", request('tag_arr'));

        if ($tag_arr) {
            $product_ids = ProductTag::WhereIn('tag_id', $tag_arr)->pluck('product_id');
        } else {
            $product_ids = null;
        }


        $products = Product::whereIn('id', $this->productLocation($request))->when($product_ids, function ($q) use ($product_ids) {
            return $q->whereIn('id', $product_ids);
        })
            ->when(request('subCategory_arr'), function ($qc) use ($request) {
                return $qc->whereIn('subCategory_id', explode(",", request('subCategory_arr')));
            })
            ->when(request('Category_arr'), function ($qCategory_arr) use ($request) {
                return $qCategory_arr->whereIn('category_id', explode(",", request('Category_arr')));
            })
            ->when(request('keyword'), function ($qkeyword) use ($request) {
                return $qkeyword->whereTranslationLike('title', '%' . $request->keyword . '%')->orWhereTranslationLike('description', '%' . $request->keyword . '%');
            })

            ->when(request('price_rang_min'), function ($price_rang) use ($request) {
                return $price_rang->whereBetween('price', array(request('price_rang_min'), request('price_rang_max')));
            })

            // ->when(request('price_sort'), function ($price_sort) use ($request) {
            //     if (request('price_sort')== 'price_HtoL'){
            //         return $price_sort->whereBetween('price', array(request('price_rang_min'), request('price_rang_max')));

            //     }
            // })

            ->InStock()->Active()->latest()->paginate($this->PaginateNumber);


        $items = ProductResource::collection($products);
        return $this->sendResponse($items, "");
    } //end of filter

    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'phone' => 'required',

        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }

        $items = Inbox::create($request->all());
        return $this->sendResponse("", "");
    } //end of search



    public function collections()
    {
        $collections = Collection::get();
        $items = CollectionResource::collection($collections);
        return $this->sendResponse($items, "");
    } //end of collections

    public function countries()
    {
        $countries = Country::get();
        $items = CountryResource::collection($countries);
        return $this->sendResponse($items, "");
    } //end of countries
    public function tags()
    {
        $items = Tag::get();
        $items = TagsResource::collection($items);
        return $this->sendResponse($items, "");
    } //end of tags
}
