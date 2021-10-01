<?php

namespace App\Http\Controllers\FrontEndAuthentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function __construct()
    {
        if (auth()->guard('customer')) {
            return redirect()->route('home');
            //auth()->guard('customer')->logout();
        }
    }


    public function index()
    {
        if (authCustomer() != null) {
            if(authCustomer()->type == 'guest'){
                session()->flash('success', __('site.guestcheckoutenabled'));
                return redirect()->route('products');
            }
            else{
                session()->flash('success', __('site.Successfully Login'));
                return redirect()->route('home');
            }
        }
        session(['setPreviousUrl' => url()->previous()]);
        return view('frontend.customer.auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required|min:6'
        ]);
        if (auth()->guard('customer')->attempt(['email' =>  $request->email, 'type'=>'guest', 'password' => $request->password, 'status' => 1], $request->get('remember'))) {
            session()->flash('success', __('site.guestcheckoutenabled'));
            return redirect(session()->get('setPreviousUrl')); // redirect to last url
            // return redirect()->route('customer.profile.index');
            // return view('frontend.customer.profile.index');
        }
        else if (auth()->guard('customer')->attempt(['email' =>  $request->email, 'password' => $request->password, 'status' => 1], $request->get('remember'))) {
            session()->flash('success', __('site.Successfully Login'));
            return redirect(session()->get('setPreviousUrl')); // redirect to last url
            // return redirect()->route('customer.profile.index');
            // return view('frontend.customer.profile.index');
        }
        else {
            session()->flash('success', __('site.Your email or password does not  correct'));
            return redirect()->back();
        }
    } //end of login
}
