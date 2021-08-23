<?php

namespace App\Http\Controllers\Dashboard;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\LocationRequest;

class LocationController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_locations'])->only('index');
        $this->middleware(['permission:create_locations'])->only('create');
        $this->middleware(['permission:update_locations'])->only('edit');
        $this->middleware(['permission:delete_locations'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $locations = Location::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.locations.index', compact('locations'));
    } //end of index
    public function create()
    {
        return view('dashboard.locations.create');
    } //end of create
    public function store(LocationRequest $request)
    {
        $request_data = $request->all();

        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/location/', 600);
        } //end of if
        $location = Location::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.locations.index');
    } //end of store


    public function show(Location $location)
    {
        //
    }
    public function edit(Location $location)
    {
        return view('dashboard.locations.edit', compact('location'));
    } //end of edit
    public function update(LocationRequest $request, Location $location)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($location->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $location->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/location/', 600);
        } //end of external if
        $location->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.locations.index');
    } //end of update
    public function destroy($location)
    {
        $item = Location::find($location);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/location/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.locations.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.locations.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Location::find($id);
        if ($item) {
            Location::create([
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
            return redirect()->route('dashboard.locations.index');
        }
    } //end of duplicate

}
