<?php

namespace App\Http\Controllers\Api\Customer;

use App\Address;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerFormRequest;
use App\Http\Requests\Api\EditCustomerFormRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\CustomerResource;
use App\Traits\ApiResponseTrait;
use App\Traits\AuthenticateUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    use AuthenticateUser;
    use ApiResponseTrait;
    use HasApiTokens, Notifiable;
    public function callRMS($IdCustomer)
    {
        createCustomerRms($IdCustomer);
    }
    public function checkPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        } else {
            return $this->sendResponse('Registered in the databases', "");
        }
    } //end of checkPhone
    public function verifyAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $verifyAccount = Customer::where('phone', $request->phone)->update([
            'verified' => 1
        ]);
        $customer = Customer::where('phone', $request->phone)->first();
        $tokenResult = $this->createAuthToken($customer);
        return $this->sendResponse($tokenResult, "");
    }
    public function RestPasswordByPhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|exists:customers,phone',
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'same:password', 'min:6'],
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        Customer::where('phone', $request->phone)->update([
            'password' => bcrypt($request->password)
        ]);
        $customer = Customer::where('phone', $request->phone)->first();
        $tokenResult = $this->createAuthToken($customer);
        return $this->sendResponse($tokenResult, "");
    }
    public function signupCustomer(CustomerFormRequest  $request)
    {
        $request_data = $request->except(['type', 'password', 'password_confirmation', 'address', 'image',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/customers/', 600);
        } // end of if
        $request_data['password'] = bcrypt($request->password);
        $request_data['deviceType'] = $request->deviceType;
        $request_data['verified'] = 1;
        $customer = Customer::create($request_data);
        $this->callRMS($customer->id);
        // if ($customer->verified == 0) {
        //   return $this->sendError('', 'Verifiy Your Account ', 201);
        // }
        $tokenResult = $this->createAuthToken($customer);
        return $this->sendResponse($tokenResult, "");
        // return $this->successResponse($tokenResult, 'customer');
    }
    public function editCustomerProfile(EditCustomerFormRequest $request)
    {
        $request_data = $request->except(['image',]);
        if ($request->image) {
            $request_data['image'] = upload_img($request->image, 'uploads/customers/', 600);
        } // end of if
        $update = $request->user()->update($request_data);
        return $this->sendResponse("", "Success update");
    }
    public function addressCustomerProfile(Request $request)
    {
        $request_data = $request->except(['type', 'password', 'password_confirmation', 'address', 'image',]);
        $update = $request->user()->update($request_data);
        return $this->sendResponse("", "Success update");
    }
    public function updateFirebaseToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firebaseToken' => 'required|string',
            'deviceType'    => 'required|string|in:ios,android',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $data = request(['firebaseToken', 'deviceType']);
        $request->user()->update($data);
        return $this->sendResponse("", "");
    }
    public function social_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'provider' => 'required' ,
            'social_id' => 'required',
            'full_name' => 'required',
            'email' => 'required',
            // 'email' => 'required|unique:customers,email',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $customer = Customer::where('provider_id', $request->social_id)->first();
        if (!$customer) {
            #not exist with email
            $customer = Customer::where('email', $request->email)->first();
            if (!$customer) {
                $pro = str_random(7);
                $customer = Customer::create([
                    'full_name'     => $request->full_name,
                    'email'    => $request->email,
                    // 'provider' => $provider,
                    'social_id' => $request->social_id,
                    'deviceType' => $request->deviceType,
                    'phone' => null,
                    'verified' => 1,
                ]);
                $customer = Auth::guard('customer')->loginUsingId($customer->id);
                $this->callRMS($customer->id);
            }
        }
        $tokenResult = $this->createAuthToken($customer);
        //return $this->successResponse($tokenResult, 'customer');
        return $this->sendResponse($tokenResult, "");
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|string|email',
            'phone' => 'required',
            'password' => 'required|string',
            //  'remember_me' => 'boolean'
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        // $credentials = request(['email', 'password']);
        $credentials = request(['phone', 'password']);
        if (!Auth::guard('customer')->attempt($credentials)) {
            return $this->sendError(' ', "Unauthorized");
        }
        $user  =  Auth::guard('customer')->user();
        // if ($user->verified == 0) {
        //   return $this->sendError('', 'Verifiy Your Account ', 201);
        // }
        $tokenResult = $this->createAuthToken($user);

        return $this->sendResponse($tokenResult, "");
        //  return $this->successResponse($tokenResult, 'customer');
    }
    public function logout(Request $request)
    {
        //authCustomerApi();
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    public function profile(Request $request)
    {
        return $this->sendResponse(new CustomerResource($request->user()), "");
    }
    public function addressCustomer(Request $request)
    {
        //  return $this->sendResponse(new AddressCustomerResource($request->user()), "");
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password|min:6',
            'old_password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $credentials = ['email' => $request->user()['email'], 'password' => $request->old_password];
        if (!Auth::guard('customer')->attempt($credentials)) {
            return $this->sendError('Password Not Correct', '');
        }
        $request->user()->update(['password' => bcrypt($request->password)]);
        return $this->sendResponse("", "");
    } //end of changePassword
    public function activatAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required|exists:addresses,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $activate = Address::where('id', $request->address_id)->where('customer_id', authCustomerApi()->id)->update([
            'status' => 'active'
        ]);
        $notActivate = Address::where('id', "!=", $request->address_id)->where('customer_id', authCustomerApi()->id)->update([
            'status' => 'not_active'
        ]);
        return $this->sendResponse("", "");
    } //end of activatAddress


    public function createAddress(Request $request)
    {
        // dd( authCustomerApi()->id);
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            // 'frirstName' => 'required',
            // 'lastName' => 'required',
            // 'phone' => 'required',
            // 'street' => 'required',
            // 'home_number' => 'required',
            // 'floor_number' => 'required',
            // 'postal_code' => 'required',
            // 'notes' => 'required',
            'city_id'=>'exists:cities,id'
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $request_data = $request->except(['postal_code',]);
        $request_data['customer_id'] = authCustomerApi()->id;


 \Log::info(print_r($request_data , true));
 
        $address =  $this->getLastAddress();
        if ($address) {
            $address->update($request_data);
        } else {
            $address = Address::create($request_data);
        }
        if($_SERVER['REMOTE_ADDR'] !== '127.0.0.1')
            createAddressRms($address->id);

        return $this->sendResponse("", "");
    } //create Address


    public function editAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required|exists:addresses,id',
            // 'frirstName' => 'required',
            // 'lastName' => 'required',
            // 'phone' => 'required',
            // 'street' => 'required',
            // 'home_number' => 'required',
            // 'floor_number' => 'required',
            // 'postal_code' => 'required',
            // 'notes' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError(' ', $validator->errors()->first());
        }
        $request_data = $request->except(['address_id']);
        $address = Address::find($request->address_id);
        $address->update($request_data);

        return $this->sendResponse("", "");
    } //create Address


    public function getLastAddress()
    {
        return Address::where('customer_id', authCustomerApi()->id)->first();
    }
    public function listAddress(Request $request)
    {
        $addres =  $this->getLastAddress();
        //      dd('ddd',$addres);
        if ($addres == null) {
            return $this->sendError('', 'no data Found ', 201);
        }

        return $this->sendResponse(new AddressResource($addres), "");
        // $address = Address::where('customer_id', authCustomerApi()->id)->get();
        // $items = AddressResource::collection($address);
        // return $this->sendResponse($items, "");
    } //listAddress
}
