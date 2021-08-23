<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class productLocationRequest extends FormRequest
{
    public $rules = [

        'product_id' => 'required',
        'stock' => 'required|numeric',
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
        $item = $this->route('addition');


        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'product_id.required' => 'أدخل المنتج ',

            'stock.numeric' => __('المخزن لابد ان يكون رقم '),


        ];
        return $msg;
    }
}

