<?php

namespace App\Http\Controllers\Dashboard;

use App\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\AboutRequest;
use App\Http\Requests\backend\PlanRequest;
use App\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PlanController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_plans'])->only('index');
        $this->middleware(['permission:create_plans'])->only('create');
        $this->middleware(['permission:update_plans'])->only('edit');
        $this->middleware(['permission:delete_plans'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $plans = Plan::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.plans.index', compact('plans'));
    } //end of plans
    public function create()
    {
        $services = Service::get();
        return view('dashboard.plans.create', compact('services'));
    } //end of create
    public function store(PlanRequest $request)
    {
        $request_data = $request->except(['images']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/plans/', 600);
        } //end of if
        $service = Plan::create($request_data);
        if ($request->file('images')) {
            $this->InsertImages($request->file('images'), $service->id);
        } //end of if
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of store
    
    public function show(Plan $plan)
    {
        //
    }
    public function edit(Plan $plan)
    {
        $services = Service::get();
        return view('dashboard.plans.edit', compact('plan', 'services'));
    } //end of edit
    public function update(PlanRequest $request, Plan $plan)
    {
        $request_data = $request->except(['image', 'images']);
        if ($request->image) {
            if ($plan->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $plan->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/plan/', 600);
        } //end of external if
        $plan->update($request_data);
        if ($request->file('images')) {
            $this->InsertImages($request->file('images'), $plan->id);
        } //end of if
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy(Plan $plan)
    {
        if ($plan->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/plans/' . $plan->image);
        } //end of if
        $plan->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    }

    public function duplicate($id)
    {
        $item = Plan::find($id);
        if ($item) {
            Plan::create([
                'service_id' =>  $item->service_id,
                'status' =>  'notactive',
                'price_egy' =>  $item->price_egy,
                'offer_egy' =>  $item->offer_egy,
                'price_usd' =>  $item->price_usd,
                'offer_usd' =>  $item->offer_usd,
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
