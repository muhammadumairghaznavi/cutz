<?php

namespace App\Http\Requests\backend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdditionRequest extends FormRequest
{
    public $rules = [

        // 'image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',
        'product_id' => 'required',
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric|lt:price',
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

            'price.numeric' => __('السعر لابد ان يكون رقم '),
            'discount.numeric' => __('السعر لابد ان يكون رقم '),
            'discount.lt' => __('الخصم لابد ان يكون اقل من سعر الاساسي'),


        ];
        return $msg;
    }
}
