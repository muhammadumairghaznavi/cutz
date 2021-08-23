<?php

namespace App\Http\Controllers\Dashboard;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CustomerFormRequest;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerExport;

class CustomerController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_customers'])->only('index');
        $this->middleware(['permission:create_customers'])->only('create');
        $this->middleware(['permission:update_customers'])->only('edit');
        $this->middleware(['permission:delete_customers'])->only('destroy');
    } //end of constructor

    public function export(Request $request)
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');


    } //end of export
    
    public function index(Request $request)
    {

        $customers = Customer::when($request->search, function ($q) use ($request) {

            return $q->where('full_name', 'like', '%' . $request->search . '%');
        })->latest()->get();

        return view('dashboard.customers.index', compact('customers'));
    } //end of index


    public function create()
    {
        return view('dashboard.customers.create');
    } //end of create

    public function store(CustomerFormRequest $request)
    {
        $request_data = $request->except(['password', 'password_confirmation', 'image']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/customers/', 600);
        } // end of if

        $request_data['password'] = bcrypt($request->password);

        $customer = Customer::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.customers.index');
    } //end of store

    public function edit(Customer $customer)
    {


        return view('dashboard.customers.edit', compact('customer'));
    } //end of edit

    public function update(CustomerFormRequest $request, Customer $customer)
    {
        $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);


        if ($request->image) {
            if ($customer->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/' . $customer->image);
            } //end of inner if
            $request_data['image'] = upload_img($request->image, 'uploads/customers/', 600);
        } //end of external if

        $customer->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.customers.index');
    } //end of update

    public function destroy(Customer $customer)
    {

        if (!$customer) {
            return redirect()->back();
        }
        if ($customer->image != 'default.png') {
            Storage::disk('public_uploads')->delete('customers/' . $customer->image);
        } //end of if

        $customer->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.customers.index');
    } //end of destroy

}//end of controller
