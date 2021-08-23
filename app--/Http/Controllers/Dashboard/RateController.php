<?php

namespace App\Http\Controllers\Dashboard;

use App\Customer;
use App\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\RateRequest;
use App\Product;

class RateController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_rates'])->only('index');
        $this->middleware(['permission:create_rates'])->only('create');
        $this->middleware(['permission:update_rates'])->only('edit');
        $this->middleware(['permission:delete_rates'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $rates = Rate::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();
        return view('dashboard.rates.index', compact('rates'));
    } //end of index
    public function create()
    {
        $products = Product::latest()->get();
        $customers = Customer::latest()->get();
        return view('dashboard.rates.create', compact('products', 'customers'));
    } //end of create
    public function store(RateRequest $request)
    {
        $request_data = $request->all();

        $rate = Rate::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.rates.index');
    } //end of store


    public function show(Rate $rate)
    {
        //
    }
    public function edit(Rate $rate)
    {
        $products = Product::latest()->get();
        $customers = Customer::latest()->get();

        return view('dashboard.rates.edit', compact('rate', 'products', 'customers'));
    } //end of edit
    public function update(RateRequest $request, Rate $rate)
    {
        $request_data = $request->except(['image',]);

        $rate->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.rates.index');
    } //end of update
    public function destroy($rate)
    {
        $item = Rate::find($rate);
        if ($item) {
            $item->delete();
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.rates.index');
        } else {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('dashboard.rates.index');
        }
    } //end of destroy

    public function duplicate($id)
    {
        $item = Rate::find($id);
        if ($item) {
            Rate::create([
                'status'  =>  $item->status,
                'product_id'  =>  $item->product_id,
                'customer_id'  =>  $item->customer_id,
                'rate'  =>  $item->rate,
                'feedback'  => "",

            ]);/* end of create */
            session()->flash('success', __('site.added_successfully'));
            return redirect()->back();
        }
    } //end of duplicate

}
