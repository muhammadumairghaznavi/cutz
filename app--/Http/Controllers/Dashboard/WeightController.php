<?php

namespace App\Http\Controllers\Dashboard;

use App\Weight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\WeightRequest;
use Illuminate\Support\Facades\Storage;

class WeightController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_weights'])->only('index');
        $this->middleware(['permission:create_weights'])->only('create');
        $this->middleware(['permission:update_weights'])->only('edit');
        $this->middleware(['permission:delete_weights'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $weights = Weight::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.weights.index', compact('weights'));
    } //end of index
    public function create()
    {
        return view('dashboard.weights.create');
    } //end of create
    public function store(WeightRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/weight/', 600);
        } //end of if
        $aeight = Weight::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store


    public function show(Weight $weight)
    {
        //
    }
    public function edit(Weight $weight)
    {
        return view('dashboard.weights.edit', compact('weight'));
    } //end of edit
    public function update(WeightRequest $request, Weight $weight)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($weight->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $weight->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/weight/', 600);
        } //end of external if
        $weight->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy($weight)
    {
        $item = Weight::find($weight);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/weight/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->back();
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->back();
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Weight::find($id);
        if ($item) {
            Weight::create([
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
