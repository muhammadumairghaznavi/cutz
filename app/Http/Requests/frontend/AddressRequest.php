<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public $rules = [
        'frirstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'city_id' => 'required',
        //  'state_id' => 'required',
        'customer_region' => 'required',
        //'result' => 'required',
    ];

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    public function createRules()
    {

        $this->rules += [];
        return $this->rules;
    }
    public function updateRules()
    {
        $this->rules += [];
        return $this->rules;
    }
    public function messages()
    {
        $msg = [];
        return $msg;
    }
}
