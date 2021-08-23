<?php

namespace App\Http\Controllers\Dashboard;

use App\About;
use App\AboutTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AboutRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_abouts'])->only('index');
        $this->middleware(['permission:create_abouts'])->only('create');
        $this->middleware(['permission:update_abouts'])->only('edit');
        $this->middleware(['permission:delete_abouts'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $abouts = About::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.abouts.index', compact('abouts'));
    } //end of index
    public function create()
    {
        return view('dashboard.abouts.create');
    } //end of create
    public function store(AboutRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/about/', 600);
        } //end of if
        $about = About::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.abouts.index');
    } //end of store


    public function show(About $about)
    {
        //
    }
    public function edit(About $about)
    {
        return view('dashboard.abouts.edit', compact('about'));
    } //end of edit
    public function update(AboutRequest $request, About $about)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($about->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $about->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/about/', 600);
        } //end of external if
        $about->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.abouts.index');
    } //end of update
    public function destroy($about)
    {
        $item = About::find($about);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/about/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.abouts.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.abouts.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = About::find($id);
        if ($item) {
            About::create([
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
            return redirect()->route('dashboard.abouts.index');
        }
    } //end of duplicate

}
