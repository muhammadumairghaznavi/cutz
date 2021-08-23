<?php

namespace App\Http\Controllers\Dashboard;

use App\Parteners;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PartenersController extends Controller
{
    public function __construct()
    {

        //create read update delete
        $this->middleware(['permission:read_parteners'])->only('index');
        $this->middleware(['permission:create_parteners'])->only('create');
        $this->middleware(['permission:update_parteners'])->only('edit');
        $this->middleware(['permission:delete_parteners'])->only('destroy');
    } //end of constructor

    public function index(Request $request)
    {
        $parteners = Parteners::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.parteners.index', compact('parteners'));
    } //end of parteners
    public function create()
    {
        return view('dashboard.parteners.create');
    } //end of create

    public function store(Request $request)
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required', Rule::unique('parteners_translations', 'title')]];
        } //end of for each
        $rules += [
            'image' => 'image:mimes:jpeg,bmp,png|max:2048',
        ];
        $request->validate($rules);
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/parteners/', 300);
        } //end of if
        Parteners::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.parteners.index');
    } //end of store

    public function show(Parteners $parteners)
    {
        //
    }


    public function edit($parteners)
    {
        $partener = Parteners::find($parteners);
        return view('dashboard.parteners.edit', compact('partener'));
    } //end of edit

    public function update(Request $request,  $parteners)
    {

        $parteners = Parteners::find($parteners);
        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.title' => ['required', Rule::unique('parteners_translations', 'title')->ignore($parteners->id, 'parteners_id')]];
        } //end of for each
        $rules += [
            'image' => 'image:mimes:jpeg,bmp,png|max:2048',
        ];
        $request->validate($rules);
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($parteners->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $parteners->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/parteners/', 300);
        } //end of external if
        $parteners->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.parteners.index');
    } //end of update

    public function destroy($parteners)
    {
        $item = Parteners::find($parteners);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/parteners/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.parteners.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.parteners.index');
        }
    } //end of destroy
}
