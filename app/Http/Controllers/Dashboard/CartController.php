<?php

namespace App\Http\Controllers\Dashboard;

use App\Cart;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_carts'])->only('index');
        $this->middleware(['permission:create_carts'])->only('create');
        $this->middleware(['permission:update_carts'])->only('edit');
        $this->middleware(['permission:delete_carts'])->only('destroy');
    } //end of constructor
    public function index(Request $request)
    {
        $carts = Cart::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('title', '%' . $request->search . '%');
        })->latest()->get();

        $customers = Customer::latest()->get();
        return view('dashboard.carts.index', compact('customers', 'carts'));
    } //end of index
    public function create()
    {
        // dd('as');
        return view('dashboard.carts.create');
    } //end of create
    public function store(Request $request)
    {
        //dd($request->all());
        $request_data = $request->all();
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/about/', 600);
        } //end of if
        $about = Cart::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.carts.index');
    } //end of store


    public function show(Cart $about)
    {
        //
    }
    public function edit(Cart $about)
    {
    } //end of edit
    public function update(Request $request, Cart $about)
    {
    } //end of update
    public function destroy($about)
    {
    } //end of destroy

}
