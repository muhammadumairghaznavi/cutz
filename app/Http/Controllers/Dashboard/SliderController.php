<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\backend\SliderRequest;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->paginate(5);

        //   dd($sliders);
        return view('dashboard.sliders.index', compact('sliders'));
    } //end of index
    public function create()
    {
        return view('dashboard.sliders.create');
    } //end of create
    public function store(SliderRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
          // dd(uploadFile($request->image, 'uploads/slider/', 1200));
            $request_data['image'] = uploadFile($request->image, 'slider/', 1200);
        } //end of if
        Slider::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.sliders.index');
    } //end of store
    public function show(Slider $slider)
    {
        //
    }
    public function edit(Slider $slider)
    {
        return view('dashboard.sliders.edit', compact('slider'));
    } //end of edit
    public function update(SliderRequest $request, Slider $slider)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            if ($slider->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $slider->image);
            } //end of inner if
            $request_data['image'] = uploadFile($request->image, 'slider/', 919);
        } //end of external if
        $slider->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.sliders.index');
    } //end of update
    public function destroy(Slider $slider)
    {
        if ($slider->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/slider/' . $slider->image);
        } //end of if
        $slider->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.sliders.index');
    } //end of destroy
}
