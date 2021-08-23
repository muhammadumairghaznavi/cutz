<?php

namespace App\Http\Controllers\Dashboard;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\PageRequest;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_pages'])->only('index');
        $this->middleware(['permission:create_pages'])->only('create');
        $this->middleware(['permission:update_pages'])->only('edit');
        $this->middleware(['permission:delete_pages'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $pages = Page::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.pages.index', compact('pages'));
    } //end of pages
    public function create()
    {
        return view('dashboard.pages.create');
    } //end of create
    public function store(PageRequest $request)
    {
        $request_data = $request->except(['image', 'file']);

  //      $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/page/', 600);
        } //end of if
        if ($request->file) {
            $request_data['file'] = upload_file($request->file, 'uploads/page/');
        } //end of if

        $page = Page::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.pages.index');
    } //end of store
    public function show(Page $page)
    {
        //
    }

    public function edit($page)
    {
        $page_edit = Page::find($page);

        return view('dashboard.pages.edit', compact('page_edit'));
    } //end of edit
    public function update(PageRequest $request, Page $page)
    {
        $request_data = $request->except(['image', 'file']);
        if ($request->image) {

            if ($page->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $page->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/page/', 600);
        } //end of external if


        if ($request->file) {

            if ($page->file != null) {
                Storage::disk('public_uploads')->delete('/' . $page->file);
            } //end of inner if

            $request_data['file'] = upload_file($request->file, 'uploads/page/');
        } //end of if







        $page->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.pages.index');
    } //end of update
    public function destroy($page)
    {
        $item = Page::find($page);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/page/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.pages.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.pages.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Page::find($id);
        if ($item) {
            Page::create([
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
            return redirect()->route('dashboard.pages.index');
        }
    } //end of duplicate

}
