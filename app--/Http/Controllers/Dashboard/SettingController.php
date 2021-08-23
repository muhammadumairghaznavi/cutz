<?php

namespace App\Http\Controllers\Dashboard;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = Setting::get();
        return view('dashboard.settings.index', compact('settings'));
    } //end of index
    public function create()
    {
        return view('dashboard.settings.create');
    } //end of create
    public function store(Request $request)
    {

        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/settings/', 1500);
        } //end of if
        Setting::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.settings.index');
    } //end of store
    public function edit(Setting $setting)
    {
        return view('dashboard.settings.edit', compact('setting'));
    } //end of edit
    public function update(Request $request, Setting $setting)
    {

        $request_data = $request->except(['logo', 'footer_logo', 'icon']);
        if ($request->logo) {
            if ($setting->logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $setting->logo);
            } //end of inner if
            $request_data['logo'] = upload_img($request->logo, 'uploads/setting/', 1500);
        } //end of external if
        if ($request->footer_logo) {
            if ($setting->footer_logo != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $setting->footer_logo);
            } //end of inner if
            $request_data['footer_logo'] = upload_img($request->footer_logo, 'uploads/setting/', 1500);
        } //end of external if
        if ($request->icon) {
            if ($setting->icon != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $setting->icon);
            } //end of inner if
            $request_data['icon'] = upload_img($request->icon, 'uploads/setting/', 1500);
        } //end of external if



        $setting->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.settings.index');
    } //end of update

    public function destroy(Setting $setting)
    {
        //
    }
}
