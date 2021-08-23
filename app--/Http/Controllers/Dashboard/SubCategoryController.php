<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\SubCategoryRequest;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{


    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_subCategories'])->only('index');
        $this->middleware(['permission:create_subCategories'])->only('create');
        $this->middleware(['permission:update_subCategories'])->only('edit');
        $this->middleware(['permission:delete_subCategories'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $subCategories = SubCategory::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.subCategories.index', compact('subCategories'));
    } //end of index

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.subCategories.create', compact('categories'));
    } //end of create

    public function store(SubCategoryRequest $request)
    {

        $request_data = $request->except(['image',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/subCategories/', 600);
        } //end of if
        SubCategory::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.subCategories.index');
    } //end of store

    public function show(SubCategory $subCategory)
    {
        //
    }


    public function edit(SubCategory $subCategory)
    {

        $categories = Category::get();
        return view('dashboard.subCategories.edit', compact('categories', 'subCategory'));
    } //end of edit
    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {

        $request_data = $request->except(['image',]);

        if ($request->image) {
            if ($subCategory->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $subCategory->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/subCategories/', 600);
        } //end of external if

        $subCategory->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.subCategories.index');
    } //end of update
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.subCategories.index');
    } //end of destroy
    public function duplicate($id)
    {
        $item = SubCategory::find($id);

        if ($item) {
            SubCategory::create([

                'image' =>  $item->image,
                'category_id' =>  $item->category_id,
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


}
