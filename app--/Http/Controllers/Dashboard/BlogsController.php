<?php

namespace App\Http\Controllers\Dashboard;

use App\Blogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\BlogRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class BlogsController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_blogs'])->only('index');
        $this->middleware(['permission:create_blogs'])->only('create');
        $this->middleware(['permission:update_blogs'])->only('edit');
        $this->middleware(['permission:delete_blogs'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $blogs = Blogs::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->paginate(30);
        return view('dashboard.blogs.index', compact('blogs'));
    } //end of blogs
    public function create()
    {
        return view('dashboard.blogs.create');
    } //end of create
    public function store(BlogRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/blogs/', 600);
        } //end of if
        Blogs::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.blogs.index');
    } //end of store
    public function show(Blogs $blog)
    {
        //
    }
    public function edit(Blogs $blog)
    {
        return view('dashboard.blogs.edit', compact('blog'));
    } //end of edit
    public function update(BlogRequest $request, Blogs $blog)
    {

        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($blog->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $blog->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/blogs/', 600);
        } //end of external if
        $blog->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.blogs.index');
    } //end of update

    public function destroy($blog)
    {
        $item = Blogs::find($blog);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/blog/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.blogs.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.blogs.index');
        }
    } //end of destroy
    public function item_delete($blog)
    {
        $item = Blogs::find($blog);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/blog/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.blogs.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.blogs.index');
        }
    } //end of destroy
    public function multiple_action(Request $request)
    {
        $rules = [
            'option' => 'required',
            'ids' => 'required',
        ];
        $request->validate($rules);
        $option = $request->option;
        $ids = $request->ids;
        if ($option == 'delete') {
            $action = Blogs::whereIn('id', $ids)->delete();
        } else {
            return redirect()->back();
        }
        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.blogs.index');
    }


    public function duplicate($id)
    {
        $item = Blogs::find($id);
        if ($item) {
            Blogs::create([
                'image' =>  $item->image,
                'date' =>  $item->date,
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
