<?php

namespace App\Http\Controllers\FrontEndAuthentication\Customer;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Ticket;

class ProfileController extends Controller
{
    ////////////////////// Start Customer  Profile ////////////////////
    public function index()
    {
        return view('frontend.customer.profile.index');
    } //end of index

    public function rate(Request $request)
    {

        $validator =  $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rate_delivery' => 'required|in:1,2,4,5',
            'rate_order' => 'required|in:1,2,4,5',

        ]);
        Order::where('id', $request->order_id)->update(['rate_delivery' => $request->rate_delivery, 'rate_order' => $request->rate_order]);
        session()->flash('success', __('site.done'));
        return redirect()->back();
    }
    public function edit(Request  $request, $id)
    {
        $customer = authCustomer();
        $validator =  $request->validate([
            'full_name' => 'required|string|max:200',
            'gender' => 'required|in:male,female',
            'phone' => 'required|unique:customers,phone,' . $customer->id,
        ]);
        $request_data = $request->except(['image']);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/customers/', 600);
        } // end of if
        $customer->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->back();
    } //end of edit
    public function change_password()
    {
        return view('frontend.customer.profile.password.change_password');
    } //end of change_password

    public function edit_password(Request  $request, $id)
    {
        $validator =  $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password|min:6',
        ]);
        $customer = authCustomer();
        $credentials = ['email' => $customer->email, 'password' => $request->old_password];
        if (!auth()->guard('customer')->attempt($credentials)) {
            session()->flash('success', __('site.Old Password Not Correct'));
        } else {
            $customer->update(['password' => bcrypt($request->password)]);
            session()->flash('success', __('site.updated_successfully'));
        }
        return redirect()->back();
    } //end of edit_password
    public function logout()
    {
        auth()->guard('customer')->logout();
        return redirect()->route('customer.login');
        //  return view('frontend.customer.auth.login');
    } //end of logout
    ////////////////////// End  Customer  Profile ////////////////////




    ////////////////////// Start Ticket Support ////////////////////
    public function tickets()
    {
        $tickets = Ticket::where('customer_id', authCustomer()->id)->latest()->get();
        return view('frontend.customer.profile.tickets.index', compact('tickets'));
    } //end of index
    public function tickets_create(Request $request)
    {
        $customer = authCustomer();
        $validator =  $request->validate([
            'section' => 'required',
            'type' => 'required',
            'message' => 'required',
        ]);
        $request_data = $request->except(['customer_id']);
        $request_data['customer_id'] = $customer->id;
        Ticket::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();
    } //end of tickets_create
    ////////////////////// End Ticket Support ////////////////////

    ////////////////////// Start Orders  ////////////////////
    public function listOrders()
    {
        $orders = Order::where('customer_id', authCustomer()->id)->get();
        return view('frontend.customer.profile.orders.index', compact('orders'));
    } //end of list orders
    public function OrderDetails($order_id)
    {
        $order = Order::find($order_id);
        $orders = OrderDetail::where('order_id', $order_id)->get();
        return view('frontend.customer.profile.orders.details', compact('order', 'orders'));
    } //end of   OrderDetails


    ////////////////////// End Orders  ////////////////////

}
