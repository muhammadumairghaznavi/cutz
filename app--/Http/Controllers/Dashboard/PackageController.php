<?php

namespace App\Http\Controllers\Dashboard;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\PackageRequest;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_packages'])->only('index');
        $this->middleware(['permission:create_packages'])->only('create');
        $this->middleware(['permission:update_packages'])->only('edit');
        $this->middleware(['permission:delete_packages'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {

        $packages = Package::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.packages.index', compact('packages'));
    } //end of packages
    public function create()
    {
        return view('dashboard.packages.create');
    } //end of create
    public function store(PackageRequest $request)
    {


        $request_data = $request->except(['image',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/packages/', 900);
        } //end of if
        Package::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store

    public function show(Package $package)
    {
        //
    }


    public function edit(Package $package)
    {


        return view('dashboard.packages.edit', compact('package'));
    } //end of edit

    public function update(PackageRequest $request, Package $package)
    {


        $request_data = $request->except(['image',]);

        if ($request->image) {
            if ($package->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $package->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/packages/', 900);
        } //end of external if

        $package->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy(Package $package)
    {
        if ($package->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/packages/' . $package->image);
        } //end of if
        $package->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    }

    public function duplicate($id)
    {
        $item = Package::find($id);

        if ($item) {
            Package::create([
                'falg' =>  $item->falg,
                'status' =>  'not active',
                'price_egy_monthly' => $item->price_egy_monthly,
                'offer_egy_monthly' => $item->offer_egy_monthly,
                'price_egy_yearly' => $item->price_egy_yearly,
                'offer_egy_yearly' => $item->offer_egy_yearly,
                'price_dollar_monthly' => $item->price_dollar_monthly,
                'offer_dollar_monthly' => $item->offer_dollar_monthly,
                'price_dollar_yearly' =>  $item->price_dollar_yearly,
                'offer_dollar_yearly' =>  $item->offer_dollar_yearly,
                'time_period' =>  $item->time_period,
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
