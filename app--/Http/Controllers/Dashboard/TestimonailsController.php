<?php

namespace App\Http\Controllers\Dashboard;

use App\Testimonails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class TestimonailsController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_testimonails'])->only('index');
        $this->middleware(['permission:create_testimonails'])->only('create');
        $this->middleware(['permission:update_testimonails'])->only('edit');
        $this->middleware(['permission:delete_testimonails'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $testimonails = Testimonails::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.testimonails.index', compact('testimonails'));
    } //end of testimonails
    public function create()
    {
        return view('dashboard.testimonails.create');
    } //end of create
    public function store(Request $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required']];
        } //end of for each
        $rules += [
            'image' => 'required|image:mimes:jpeg,bmp,png|max:2048',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $request->validate($rules);
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/testimonails/', 1500);
        } //end of if
        Testimonails::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.testimonails.index');
    } //end of store
    public function show(Testimonails $testimonails)
    {
    }
    public function edit($testimonails)
    {
        $testimonail = Testimonails::find($testimonails);
        return view('dashboard.testimonails.edit', compact('testimonail'));
    } //end of edit
    public function update(Request $request,  $testimonails)
    {
        $testimonail = Testimonails::find($testimonails);

        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required']];
            //$rules += [$locale . '.title' => ['required', Rule::unique('testimonails_translations', 'title')->ignore($testimonail->id, 'testimonails_id')]];
        } //end of for each
        $rules += [
            'image' => 'image:mimes:jpeg,bmp,png|max:2048',
        ];
        $request->validate($rules);
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($testimonails->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $testimonails->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/testimonails/', 1500);
        } //end of external if
        $testimonail->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.testimonails.index');
    } //end of update
    public function destroy($testimonails)
    {
        $item = Testimonails::find($testimonails);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/testimonails/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.testimonails.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.testimonails.index');
        }
    } //end of destroy
}
