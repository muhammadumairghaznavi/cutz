<?php

namespace App\Http\Controllers\Dashboard;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CityRequest;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_cities'])->only('index');
        $this->middleware(['permission:create_cities'])->only('create');
        $this->middleware(['permission:update_cities'])->only('edit');
        $this->middleware(['permission:delete_cities'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $cities = City::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.cities.index', compact('cities'));
    } //end of index
    public function create()
    {
        $countries = Country::get();

        return view('dashboard.cities.create', compact('countries'));
    } //end of create
    public function store(CityRequest $request)
    {
        $request_data = $request->all();
        $city = City::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.cities.index');
    } //end of store
    public function show(City $city)
    {
        //
    }
    public function edit(City $city)
    {
        $countries = Country::get();


        return view('dashboard.cities.edit', compact('city', 'countries'));
    } //end of edit
    public function update(CityRequest $request, City $city)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($city->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $city->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/city/', 600);
        } //end of external if
        $city->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.cities.index');
    } //end of update
    public function destroy($city)
    {
        $item = City::find($city);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/city/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.cities.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.cities.index');
        }
    } //end of destroy
    public function duplicate($id)
    {
        $item = City::find($id);
        if ($item) {
            City::create([
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
            return redirect()->route('dashboard.cities.index');
        }
    } //end of duplicate
}
