<?php

namespace App\Http\Controllers\Dashboard;

use App\Collection;
use App\CollectionProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CollectionRequest;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_collections'])->only('index');
        $this->middleware(['permission:create_collections'])->only('create');
        $this->middleware(['permission:update_collections'])->only('edit');
        $this->middleware(['permission:delete_collections'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $collections = Collection::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.collections.index', compact('collections'));
    } //end of index
    public function create()
    {
        $products = Product::get();
        return view('dashboard.collections.create', compact('products'));
    } //end of create
    public function store(CollectionRequest $request)
    {
        $request_data = $request->except(['product_id', 'image']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/product_images/', 600);
        } //end of if
        $collection = Collection::create($request_data);

        if ($request->product_id) {
            $this->product_collection_create($request->product_id, $collection->id);
        } //end of product_id

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.collections.index');
    } //end of store

    public function product_collection_create($product_id, $collection_id)
    {
        if ($product_id) {
            $input = Input::all();
            foreach ($input['product_id'] as $index => $value) {
                CollectionProduct::create(['product_id' => $input['product_id'][$index], 'collection_id' => $collection_id]);
            }
        }
    } // insert product_collection_create
    public function show(Collection $collection)
    {
        //
    }
    public function edit(Collection $collection)
    {
        if (count($collection->products) > 0) {

            foreach ($collection->products as $item) {
                $products = Product::where('id', '!=', $item->id)->get();
            }
        } else {

            $products = Product::get();
        }
        return view('dashboard.collections.edit', compact('collection', 'products'));
    } //end of edit
    public function update(CollectionRequest $request, Collection $collection)
    {
        $request_data = $request->except(['product_id', 'image']);

        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($collection->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $collection->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/product_images/', 600);
        } //end of external if
        $collection->update($request_data);
        if ($request->product_id) {
            CollectionProduct::where('collection_id', $collection->id)->delete();
            $this->product_collection_create($request->product_id, $collection->id);
        } //end of product_id


        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy($collection)
    {
        $item = Collection::find($collection);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/collection/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.collections.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.collections.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Collection::find($id);
        if ($item) {
            Collection::create([
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
            return redirect()->route('dashboard.collections.index');
        }
    } //end of duplicate

}
