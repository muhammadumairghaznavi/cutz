<?php

namespace App\Http\Controllers;

use App\About;
use App\Blogs;
use App\Brands;
use App\Category;
use App\CategoryGallery;
use App\Customer;
use App\Gallery;
use App\Http\Requests\frontend\ContactRequest;
use App\Http\Requests\frontend\QuoteRequest;
use App\Inbox;
use App\Package;
use App\Page;
use App\Parteners;
use App\Product;
use App\Review;
use App\ProductTag;
use App\Quote;
use App\Section;
use App\Service;
use App\Slider;
use App\SubCategory;
use App\Subscribe;
use App\Tag;
use App\ProvenanceCategory;

use App\Testimonails;
use App\Traits\FrontendTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Victorybiz\GeoIPLocation\GeoIPLocation;

class HomeController extends Controller
{
    use FrontendTrait;

    public function __construct()
    {
        // $this->middleware('auth');
    }



    public function index()
    {
        // dd('Coming Soon . . . ');
        //   auth()->guard('customer')->login(Customer::first());
        $bestSellers = Product::BestSeller()->InStock()->Active()->latest()->paginate($this->PaginateNumber);
        //$sliders = Slider::latest()->take(20)->get();
        $sliders = Slider::orderBy('id','desc')->take(20)->get();
        //dd($sliders);
        $categories = Category::where('home_page', '=', 'active')->Sort()->take(30)->get(); //->sortBy('title');

        $countUsefulInformation = Blogs::UsefulInformation()->count();
        $countRecipes = Blogs::Recipes()->count();
        $reviews = Review::where('status', '1')->orderBy('created_at', 'DESC')->take(6)->get();

        return view('frontend.home', compact('sliders', 'bestSellers', 'categories', 'countRecipes', 'countUsefulInformation', 'reviews'));
    } //end of index

    public function page_details($type)
    {
        $pages = Page::where('type', $type)->latest()->paginate($this->PaginateNumber);
        return view('frontend.pages', compact('pages', 'type'));
    }
    public function about()
    {
        $abouts = About::get();
        $parteners = Parteners::get();
        return view('frontend.about', compact('abouts', 'parteners'));
    } //end of about
    public function certificate()
    {

        return view('frontend.certificate');
    } //end of about


    public function galleriesImages()
    {
        $galleries = CategoryGallery::where('link', null)->latest()->paginate($this->PaginateNumber);
        return view('frontend.galleries', compact('galleries'));
    } //end of galleriesImages
    public function galleriesVideos()
    {
        $galleries = CategoryGallery::where('link', '!=', null)->latest()->paginate($this->PaginateNumber);
        return view('frontend.galleries', compact('galleries'));
    } //end of galleriesVideos


    public function galleries()
    {
        $galleries = CategoryGallery::latest()->paginate($this->PaginateNumber);

        return view('frontend.galleries', compact('galleries'));
    } //end of galleries
    public function gallery_detial($id, $slug)
    {
        $gallery = CategoryGallery::find($id);
        $galleries = Gallery::where('category_gallery_id', $id)->latest()->paginate($this->PaginateNumber);

        return view('frontend.gallery_detial', compact('gallery', 'galleries'));
    } //end of gallery_detial

    public function recipes()
    {
        // $blogs = Blogs::Recipes()->latest()->paginate($this->PaginateNumber);
        // $page = 'recipes';
        // return view('frontend.blogs', compact('blogs', 'page'));
        return view('frontend.recipes');
    } //end of Recipes


    public function blogs()
    {
        $blogs = Blogs::UsefulInformation()->latest()->paginate($this->PaginateNumber);

        $page = 'useful_information';
        return view('frontend.blogs', compact('blogs', 'page'));
    } //end of blogs
    public function blog_detail($id, $slug)
    {
        $blog = Blogs::findorfail($id);
        $blogs = Blogs::where('id', '!=', $id)->where('type', $blog->type)->latest()->get();

        return view('frontend.blog_detail', compact('blogs', 'blog'));
    } //end of blog_detail



    public function elite_products()
    {
        $products = Product::Elite()->InStock()->Active()->latest()->paginate($this->PaginateNumber);
        return view('frontend.elite_products', compact('products'));
    } //end of elite_products
    public function products()
    {
        $products = Product::NotElite()->InStock()->Active()->latest()->paginate($this->PaginateNumber);
        $tags = Tag::inRandomOrder()->take(20)->get();
        $sections = Section::take(20)->get();

        $categories = Category::inRandomOrder()->take(20)->get();
        $price_max = Product::max('price');
        $price_min = Product::min('price');


        return view('frontend.products', compact('sections', 'products', 'tags', 'categories', 'price_max', 'price_min'));
    } //end of products
    public function product_details($id, $slug)
    {
        $product =  Product::findOrfail($id);
        $provenanceCategory = ProvenanceCategory::where('provenance_id', $product->provenance_id)->where('category_id', $product->category_id)->first();




        return view('frontend.product_details', compact('product', 'provenanceCategory'));
    } //end of product_details
    public function subCategories($id, $slug)
    {
        $category = Category::findOrfail($id);
        $subCategories =  SubCategory::where('category_id', $id)->get();

        return view('frontend.subCategories', compact('category', 'subCategories'));
    } //end of subCategories

    public function productsSubCategories($id, $slug)
    {
        $sections = Section::take(20)->get();

        $products = Product::where('subCategory_id', $id)->InStock()->Active()->latest()->paginate($this->PaginateNumber);
        $tags = Tag::inRandomOrder()->take(20)->get();
        $categories = Category::inRandomOrder()->take(20)->get();

        $price_max = Product::max('price');
        $price_min = Product::min('price');


        return view('frontend.products', compact('sections', 'products', 'tags', 'categories', 'price_max', 'price_min'));
    }

    public function product_search(Request $request)
    {
        $sections = Section::take(20)->get();
        $price_max = Product::max('price');
        $price_min = Product::min('price');

        //       dd($request->all());
        $categories = Category::take(20)->get();
        $tags = Tag::take(10)->get();
        if (request('tag_arr')) {
            $product_ids = ProductTag::WhereIn('tag_id', request('tag_arr'))->pluck('product_id');
        } else {
            $product_ids = null;
        }



        $products = Product::when($product_ids, function ($q) use ($product_ids) {
            return $q->whereIn('id', $product_ids);
        })
            ->when(request('subCategory_arr'), function ($qc) use ($request) {
                return $qc->whereIn('subCategory_id', request('subCategory_arr'));
            })
            ->when(request('category_id'), function ($qc) use ($request) {
                return $qc->where('category_id', request('category_id'));
            })
            ->when(request('section_id'), function ($qc) use ($request) {
                return $qc->where('section_id', request('section_id'));
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


        return view('frontend.search', compact('sections', 'products', 'tags', 'categories', 'price_max', 'price_min'));
    } //end of product_search


    public function contact()
    {
        $num1 = rand(1, 4);
        $num2 = rand(1, 4);
        return view('frontend.contact', compact('num1', 'num2'));
    } //end of privacies
    public function post_contact(ContactRequest $request)
    {
        $request->validate([
            'phone' => 'required',
            'name' => 'required',
            'message' => 'required',
            'email' => 'required|email',
        ]);
        $request_data = $request->except(['num1', 'num2', 'result']);
        Inbox::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of post_contact
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $request_data = $request->except(['']);
        Subscribe::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of subscribe
    public function privacies()
    {
        $page = 'privacies';
         $item = Page::where('type', 'privacies')->first();
        return view('frontend.privacies', compact('item','page'));
    } //end of privacies
    public function polices()
    {
        $page = 'polices';
        $item = Page::where('type', 'polices')->first();
        return view('frontend.polices', compact('item','page'));
    } //end of polices



}
