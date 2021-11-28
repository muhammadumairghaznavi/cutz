<?php

namespace App\Http\Controllers\FrontEndAuthentication;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\CustomerFormRequest;
use App\Mail\RegCustomer;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    public function index()
    {
        
        if (authCustomer() != null) {
            session()->flash('success', __('site.Successfully Login'));
            return redirect()->route('home');
            // auth()->guard('customer')->logout();
        }
        session(['setPreviousUrl' => url()->previous()]);
        return view('frontend.customer.auth.register');
    } //end of index
    public function create(CustomerFormRequest $request)
    {
       
        $data = $request->except(['password', 'password_confirmation',   'image',]);
        // dd($data);
        if ($request->image) {
            $data['image'] = upload_img($request->image, 'customers/', '300');
        } // end of if
        $data['password'] = bcrypt($request->password);
       
        Mail::to($data['email'])->send(new RegCustomer($data));
         $customer = Customer::create($data);
        
        
        // Auth::login($customer->id);
        $result =    Auth::guard('customer')->loginUsingId($customer->id);


        $this->callRMS($customer->id);


        session()->flash('success',  __('site.Success Regesteration'));
        return redirect(session()->get('setPreviousUrl'));


        //   return redirect()->back();
        //   return redirect()->route('customer.login');
    } //end of store
    
    
    public function guestCreate(Request $request){

 
        //dd($request->all());
        $data = $request->except(['password', 'password_confirmation',   'image',]);
        // dd($data);
        if($request->image){

            $data['image'] = upload_img($request->image, 'customers/', '300');

        }


        $data['type'] = 'guest';
        $data['status'] = 1;
        $data['approved'] = 1;
        $data['verified'] = 1;
        $data['password'] =$request->password;
        
        Mail::to($data['email'])->send(new RegCustomer($data));


        $customer = Customer::create($data);

        // dd($customer->id);
        $result = Auth::guard('customer')->loginUsingId($customer->id);
    
    
        $this->callRMS($customer->id);

        session()->flash('success', __('site.guestcheckoutenabled'));

        return redirect(session()->get('setPreviousUrl'));

    }





    public function handleProviderCallback()
    {
        # code...
    }

    public function callRMS($IdCustomer)
    {
        createCustomerRms($IdCustomer);

    }

}
