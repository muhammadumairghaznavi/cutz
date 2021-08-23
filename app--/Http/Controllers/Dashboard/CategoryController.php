<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Exports\CategoryExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CategoryRequest;
use App\Section;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_categories'])->only('index');
        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only('destroy');
    } //end of constructor

    public function export()
    {
        return Excel::download(new CategoryExport, 'CategoryExport.xlsx');
    }


    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->Sort()->get();//orderBy('sort', 'desc')->get();
        return view('dashboard.categories.index', compact('categories'));
    } //end of index
    public function create()
    {
        $sections = Section::get();

        return view('dashboard.categories.create', compact('sections'));
    } //end of create
    public function store(CategoryRequest $request)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/categories/', 600);
        } //end of if
        Category::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    } //end of store


    public function edit(Category $category)
    {
        $sections = Section::get();

        return view('dashboard.categories.edit', compact('sections', 'category'));
    } //end of edit
    public function update(CategoryRequest $request, Category $category)
    {
        $request_data = $request->except(['image',]);

        if ($request->image) {
            if ($category->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $category->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/categories/', 600);
        } //end of external if

        $category->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');
    } //end of update
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    } //end of destroy


    public function duplicate($id)
    {
        $item = Category::find($id);

        if ($item) {
            Category::create([

                'section_id' =>  $item->section_id,
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
}//end of controller
