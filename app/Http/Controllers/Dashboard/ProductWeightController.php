<?php

namespace App\Http\Controllers\Dashboard;

use App\ProductWeight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\ProductWeightRequest;
use App\Product;
use App\Weight;
use Illuminate\Support\Facades\Storage;

class ProductWeightController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_productWeights'])->only('index');
        $this->middleware(['permission:create_productWeights'])->only('create');
        $this->middleware(['permission:update_productWeights'])->only('edit');
        $this->middleware(['permission:delete_productWeights'])->only('destroy');
    } //end of constructor
    public function index(Request $request, Product $product)
    {
        $productWeights = ProductWeight::when($request->search, function ($q) use ($request) {
            return $q->Where('product_id',  $request->search);
        })->latest()->get();

        $product_id = $request->search;

        return view('dashboard.productWeights.index', compact('productWeights', 'product_id'));
    } //end of index
    public function create(Request $request)
    {
        $products = Product::get();
        $weights = Weight::get();

        $product_id = $request->product_id;

        return view('dashboard.productWeights.create', compact('products', 'weights', 'product_id'));
    } //end of create
    public function store(ProductWeightRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/productWeight/', 600);
        } //end of if
        $productWeight = ProductWeight::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store


    public function show(ProductWeight $productWeight)
    {
    }
    public function edit(ProductWeight $productWeight)
    {
        $products = Product::get();
        $weights = Weight::get();


        return view('dashboard.productWeights.edit', compact('productWeight', 'products', 'weights'));
    } //end of edit
    public function update(ProductWeightRequest $request, ProductWeight $productWeight)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($productWeight->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $productWeight->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/productWeight/', 600);
        } //end of external if
        $productWeight->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy($productWeight)
    {
        $item = ProductWeight::find($productWeight);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/productWeight/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->back();
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->back();
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = ProductWeight::find($id);
        if ($item) {
            ProductWeight::create([
                'image' =>  $item->image,
                'ar' => [
                    'title' => $item->title . 'copy' . $item->id,
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
                'en' => [
                    'title' => $item->title . 'copy' . $item->id,
                    'description'  => $item->description,
                    'short_description' => $item->short_description,
                ],
            ]);/* end of create */
            session()->flash('success', __('site.added_successfully'));
            return redirect()->back();
        }
    } //end of duplicate

    public function showproductWeights(Request $request, Product $product){

        $productWeights = ProductWeight::when($request->search, function ($q) use ($request) {
            return $q->Where('product_id',  $request->search);
        })->latest()->get();

        $product_id = $request->search;

        return view('dashboard.productWeights.index', compact('productWeights', 'product_id'));
    }
}
