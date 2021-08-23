<?php

namespace App\Http\Requests\Api;

use App\Customer;
use App\Traits\APIRequest;
use Illuminate\Contracts\Validation\Rule;

class EditCustomerFormRequest extends APIRequest
{
    public $rules = [];

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $customer = request()->user()['id'];
        $this->rules += [
            'full_name' => 'required|string|max:200',
            'gender' => 'required|in:male,female',
            'deviceType' => "required|in:ios,android",
            'email' => 'required|string|unique:customers,email,' . $customer,
            'phone' => 'required|string|unique:customers,phone,' . $customer,
            //  'password' => ['required', 'string', 'min:6'],
            //  'password_confirmation' => ['required', 'same:password', 'min:6'],
            'image' => 'image:mimes:jpeg,bmp,png|max:2048',
        ];

        return $this->rules;
    }
}
