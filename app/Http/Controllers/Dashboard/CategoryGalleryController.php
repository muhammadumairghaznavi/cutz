<?php

namespace App\Http\Controllers\Dashboard;

use App\CategoryGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryGalleryController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_category_galleries'])->only('index');
        $this->middleware(['permission:create_category_galleries'])->only('create');
        $this->middleware(['permission:update_category_galleries'])->only('edit');
        $this->middleware(['permission:delete_category_galleries'])->only('destroy');
    } //end of constructor



    public function index(Request $request)
    {
        $category_galleries = CategoryGallery::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.category_galleries.index', compact('category_galleries'));
    } //end of index
    public function create()
    {

        return view('dashboard.category_galleries.create');
    } //end of create
    public function store(Request $request)
    {
        $request_data = $request->except(['image', 'images',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/galleries/', 755);
        } //end of if
        $category = CategoryGallery::create($request_data);
        if ($request->file('images')) {
            $this->InsertImages($request->file('images'), $category->id);
        } //end of if
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.category_galleries.index');
    } //end of store


    public function edit($category)
    {
        $category = CategoryGallery::find($category);

        return view('dashboard.category_galleries.edit', compact('category'));
    } //end of edit

    public function update(Request $request, $category)
    {
        $category = CategoryGallery::find($category);
        $request_data = $request->except(['image', 'images',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($category->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $category->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/galleries/', 755);
        } //end of external if
        $category->update($request_data);
        if ($request->file('images')) {
            $this->InsertImages($request->file('images'), $category->id);
        } //end of if
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.category_galleries.index');
    } //end of update
    public function destroy(CategoryGallery $CategoryGallery)
    {
        $CategoryGallery->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.category_galleries.index');
    } //end of destroy



}//end of controller
