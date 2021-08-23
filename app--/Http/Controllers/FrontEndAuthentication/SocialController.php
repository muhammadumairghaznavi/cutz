<?php

namespace App\Http\Controllers\FrontEndAuthentication;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);
        auth()->guard('customer')->login($user, true);
        return redirect()->route('home');
    }

    function createUser($getInfo, $provider)
    {

        #not exist with provider_id
        $user = Customer::where('provider_id', $getInfo->id)->first();

        if (!$user) {

            #not exist with email
            $user = Customer::where('email', $getInfo->email)->first();
            if (!$user) {

                $user = Customer::create([
                    'full_name'     => $getInfo->name,
                    'email'    => $getInfo->email,
                    'provider' => $provider,
                    'provider_id' => $getInfo->id
                ]);
                  $this->callRMS($user->id);
            }
        }

        return $user;
    }
    
    

    public function callRMS($IdCustomer)
    {
        createCustomerRms($IdCustomer);
    }
    
}
