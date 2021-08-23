<?php

namespace App\Http\Controllers\Dashboard;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CountryRequest;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_countries'])->only('index');
        $this->middleware(['permission:create_countries'])->only('create');
        $this->middleware(['permission:update_countries'])->only('edit');
        $this->middleware(['permission:delete_countries'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $countries = Country::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.countries.index', compact('countries'));
    } //end of index
    public function create()
    {

        return view('dashboard.countries.create');
    } //end of create
    public function store(CountryRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/country/', 600);
        } //end of if
        $country = Country::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.countries.index');
    } //end of store


    public function show(Country $country)
    {
        //
    }
    public function edit(Country $country)
    {
        return view('dashboard.countries.edit', compact('country'));
    } //end of edit
    public function update(CountryRequest $request, Country $country)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($country->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $country->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/country/', 600);
        } //end of external if
        $country->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.countries.index');
    } //end of update
    public function destroy($country)
    {
        $item = Country::find($country);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/country/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.countries.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.countries.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Country::find($id);
        if ($item) {
            Country::create([
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
            return redirect()->route('dashboard.countries.index');
        }
    } //end of duplicate

}
