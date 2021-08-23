<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{
    public $rules = [

        'product_id' => 'required',
        'customer_id' => 'required',
        'rate' => 'required',

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

        return $this->rules;
    }
    public function updateRules()
    {

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            //'image.required' => __('message.image'),
        ];
        return $msg;
    }
}
