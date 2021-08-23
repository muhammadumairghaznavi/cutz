<?php

namespace App\Http\Controllers\Dashboard;

use App\Addition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdditionRequest;
use App\Product;
use Illuminate\Support\Facades\Storage;

class AdditionController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_additions'])->only('index');
        $this->middleware(['permission:create_additions'])->only('create');
        $this->middleware(['permission:update_additions'])->only('edit');
        $this->middleware(['permission:delete_additions'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $products = Product::get();
        $additions = Addition::when($request->search, function ($q) use ($request) {
            return $q->where('title_en', $request->search);
        })->when($request->product_id, function ($q) use ($request) {
            return $q->where('product_id', $request->product_id);
        })->latest()->get();
        return view('dashboard.additions.index', compact('products', 'additions'));
    } //end of index
    public function create(Request $request)
    {

        $products = Product::where('id',$request->product_id)->get();
        return view('dashboard.additions.create', compact('products'));
    } //end of create
    public function store(AdditionRequest $request)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/additions/', 600);
        } //end of if
        Addition::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store
    public function show(Addition $addition)
    {
        //
    }
    public function edit(Addition $addition)
    {
        $products = Product::get();
        return view('dashboard.additions.edit', compact('products', 'addition'));
    } //end of edit
    public function update(AdditionRequest $request, Addition $addition)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            if ($addition->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $addition->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/additions/', 600);
        } //end of external if
        $addition->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy(Addition $addition)
    {
        $addition->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
    public function duplicate($id)
    {
        $item = Addition::find($id);
        if ($item) {
            Addition::create([
                'product_id' =>  $item->product_id,
                'image' =>  $item->image,
                'title_en' =>  $item->title_en,
                'title_ar' =>  $item->title_ar,
                'price' =>  $item->price,

            ]);/* end of create */
            session()->flash('success', __('site.added_successfully'));
            return redirect()->back();
        }
    } //end of duplicate
}
