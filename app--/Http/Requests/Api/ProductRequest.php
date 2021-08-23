<?php

namespace App\Http\Requests\Api;
use App\Traits\APIRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductRequest extends FormRequest
{
    
    public $rules = [
        'full_name'=>'required|string|max:200',
        'gender'=>'required|in:male,female',
        'type'=>"required|in:vendor,customer",

    ];

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if( $this->requestType=='create' ) {
            
            return $this->createRules();
        } elseif ( $this->requestType=='edit' ) {
            return $this->updateRules();
        }else{
            return $this->rules;
        }
    }

    public function createRules(){
        $this->rules+=[
             'email' => 'required|unique:customers,email',
            'phone'=>'required|unique:customers',
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'same:password', 'min:6'],
            'image' => 'image:mimes:jpeg,bmp,png|max:2048',

        ];
        return $this->rules;
    }

    public function updateRules(){
        $customer =request()->user()['id'];
        $this->rules+=[
             'email' => ['required', Rule::unique('customers', 'email')->ignore($customer->id, 'id')],
            'phone'=>'required|unique:customers,phone,'.$customer,
            'image' => 'image:mimes:jpeg,bmp,png|max:2048',
        ];
        return $this->rules;
    }

}
