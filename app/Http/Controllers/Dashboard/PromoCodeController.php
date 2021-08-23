<?php

namespace App\Http\Controllers\Dashboard;

use App\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PromocodeFormRequest;

class PromoCodeController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_promocodes'])->only('index');
        $this->middleware(['permission:create_promocodes'])->only('create');
        $this->middleware(['permission:update_promocodes'])->only('edit');
        $this->middleware(['permission:delete_promocodes'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $promocodes = PromoCode::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.promocodes.index', compact('promocodes'));
    } //end of index
    public function create()
    {
        return view('dashboard.promocodes.create');
    } //end of create
    public function store(PromocodeFormRequest $request)
    {
        $request_data = $request->all();
        $page = PromoCode::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.promocodes.index');
    } //end of store
    public function show(PromoCode $promoCode)
    {
        //
    }
    public function edit(PromoCode  $promocode)
    {
        return view('dashboard.promocodes.edit', compact('promocode'));
    } //end of edit
    public function update(PromocodeFormRequest $request, PromoCode  $promocode)
    {
        $request_data = $request->except(['']);
        $promocode->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of update
    public function destroy(PromoCode $promocode)
    {

        $promocode->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->back();
    } //end of destroy
}
