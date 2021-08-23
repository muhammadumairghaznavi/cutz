<?php

namespace App\Http\Controllers\Dashboard;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AboutRequest;
use App\Http\Requests\backend\ServiceRequest;
use App\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_services'])->only('index');
        $this->middleware(['permission:create_services'])->only('create');
        $this->middleware(['permission:update_services'])->only('edit');
        $this->middleware(['permission:delete_services'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $services = Service::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.services.index', compact('services'));
    } //end of services
    public function create()
    {
        return view('dashboard.services.create');
    } //end of create
    public function store(ServiceRequest $request)
    {
        $request_data = $request->except(['images']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/services/', 1000);
        } //end of if
        $service = Service::create($request_data);
        if ($request->file('images')) {
            $this->InsertImages($request->file('images'), $service->id);
        } //end of if
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.services.index');
    } //end of store
    public function show(Service $service)
    {
        //
    }
    public function edit(Service $service)
    {
        $attachments = $service->service_images;
        return view('dashboard.services.edit', compact('service', 'attachments'));
    } //end of edit
    public function update(ServiceRequest $request, Service $service)
    {
        $request_data = $request->except(['image', 'images']);
        if ($request->image) {
            if ($service->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $service->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/services/', 1000);
        } //end of external if
        $service->update($request_data);
        if ($request->file('images')) {
            $this->InsertImages($request->file('images'), $service->id);
        } //end of if
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.services.index');
    } //end of update
    public function destroy(Service $service)
    {
        if ($service->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/services/' . $service->image);
        } //end of if
        $service->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    }
    public function delete_image($id)
    {
        $img = ImageService::find($id);
        if ($img->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/services/' . $img->image);
        } //end of if
        $img->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    }
    public function InsertImages($request, $last_id)
    {
        $data = MultipleUploadImages($request, 'uploads/services/', 300);
        foreach ($data as $file_name) {
            ImageService::insert([
                'image' => $file_name,
                'service_id' => $last_id,
            ]);
        }
    } //insert images
    public function duplicate($id)
    {
        $item = Service::find($id);
        if ($item) {
            Service::create([
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
            return redirect()->route('dashboard.services.index');
        }
    } //end of duplicate
}
