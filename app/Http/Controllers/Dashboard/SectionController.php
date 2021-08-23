<?php

namespace App\Http\Controllers\Dashboard;

use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\SectionRequest;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_sections'])->only('index');
        $this->middleware(['permission:create_sections'])->only('create');
        $this->middleware(['permission:update_sections'])->only('edit');
        $this->middleware(['permission:delete_sections'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $sections = Section::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->Sort()->get();
        return view('dashboard.sections.index', compact('sections'));
    } //end of index
    public function create()
    {
        return view('dashboard.sections.create');
    } //end of create


    public function store(SectionRequest $request)
    {
        $request_data = $request->except(['image', 'icon']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/sections/', 600);
        } //end of if
        if ($request->icon) {
            $request_data['icon'] = upload_img($request->icon, 'uploads/sections/', 1000);
        } //end of if
        Section::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.sections.index');
    } //end of store

    public function show(Section $section)
    {
        //
    }


    public function edit(Section $section)
    {
        return view('dashboard.sections.edit', compact('section'));
    } //end of edit
    public function update(SectionRequest $request, Section $section)
    {

        $request_data = $request->except(['image', 'icon',]);

        if ($request->image) {
            if ($section->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $section->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/sections/', 600);
        } //end of external if

        if ($request->icon) {
            if ($section->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $section->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/sections/', 1000);
        } //end of external if

        $section->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.sections.index');
    } //end of update
    public function destroy(Section $section)
    {
        $section->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.sections.index');
    } //end of destroy
    public function duplicate($id)
    {
        $item = Section::find($id);

        if ($item) {
            Section::create([

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

}
