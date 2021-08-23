<?php

namespace App\Http\Controllers\Dashboard;

use App\Brands;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BrandsController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brands::select()->latest()->paginate(5);
        return view('dashboard.brands.index', compact('brands'));
    } //end of index
    public function create()
    {
        return view('dashboard.brands.create');
    } //end of create
    public function store(BrandRequest $request)
    {
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/brand/', 300);
        } //end of if
        Brands::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store
    public function show(Brands $brands)
    {
        //
    }
    public function edit(Brands $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    } //end of edit
    public function update(BrandRequest $request, $brands)
    {
        $brands = Brands::find($brands);
        $request_data = $request->except(['image']);
        if ($request->image) {
            if ($brands->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $brands->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/brand/', 300);
        } //end of external if
        $brands->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy($brands)
    {
        $brands = Brands::find($brands);
        if ($brands->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/brand/' . $brands->image);
        } //end of if
        $brands->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.brands.index');
    } //end of destroy
}
