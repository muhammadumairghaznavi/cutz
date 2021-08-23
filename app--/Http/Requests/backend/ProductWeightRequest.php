<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductWeightRequest extends FormRequest
{
    public $rules = [
        'product_id' => 'required',
        'weight_id' => 'required',
        'price' => 'required|numeric|max:10000000',
        'discount' => 'nullable|numeric|lt:price',
        'stock' => 'nullable|numeric|gt:0',
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
            'price.numeric' => 'لا بد ان يكون رقما',
            'discount.numeric' => __('السعر لابد ان يكون رقم '),
            'discount.lt' => __('الخصم لابد ان يكون اقل من سعر الاساسي'),
            'stock.gt' => __('اقل قيمة للمخزن لابد ان تكون اكبر من الصفر'),
            'serve_number.gt' => __('اقل قيمة   لابد ان تكون اكبر من الصفر'),

        ];
        return $msg;
    }
}
