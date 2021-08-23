<?php

namespace App\Http\Controllers\Dashboard;

use App\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AdRequest;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_ads'])->only('index');
        $this->middleware(['permission:create_ads'])->only('create');
        $this->middleware(['permission:update_ads'])->only('edit');
        $this->middleware(['permission:delete_ads'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $ads = Ad::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.ads.index', compact('ads'));
    } //end of index
    public function create()
    {
        return view('dashboard.ads.create');
    } //end of create
    public function store(AdRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/ad/', 600);
        } //end of if
        $ad = Ad::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.ads.index');
    } //end of store


    public function show(Ad $ad)
    {
        //
    }
    public function edit(Ad $ad)
    {
        return view('dashboard.ads.edit', compact('ad'));
    } //end of edit
    public function update(AdRequest $request, Ad $ad)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            //check if img not empty remove the current img to replace the new img
            if ($ad->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $ad->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/ad/', 600);
        } //end of external if
        $ad->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.ads.index');
    } //end of update
    public function destroy($ad)
    {
        $item = Ad::find($ad);
        if ($item) {
            if ($item->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/ad/' . $item->image);
            } //end of if
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.ads.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.ads.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Ad::find($id);
        if ($item) {
            Ad::create([
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
