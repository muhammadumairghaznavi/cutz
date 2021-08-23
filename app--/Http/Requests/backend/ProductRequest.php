<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public $rules = [
        'section_id' => 'required',
        'category_id' => 'required',
        'subCategory_id' => 'required',
        'price' => 'required|numeric|max:10000000',
        'discount' => 'nullable|numeric|lt:price',
        'stock' => 'nullable|numeric|gt:0',
        'serve_number' => 'nullable|numeric|gt:0',
        //  'offer_egy_monthly' => 'numeric|lt:price_egy_monthly',
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
        foreach (config('translatable.locales') as $locale) {
            // $this->rules += [$locale . '.title' => 'required|unique:product_translations,title'];
            $this->rules += [$locale . '.title' => 'required'];
        } // end of  for each
        $this->rules += ['image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',];
        $this->rules += ['image_flag' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',];

        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('product');
        foreach (config('translatable.locales') as $locale) {
            //  $this->rules += [$locale . '.title' => ['required', Rule::unique('product_translations', 'title')->ignore($item->id, 'product_id')]];
            $this->rules += [$locale . '.title' => ['required']];
        } // end of  for each
        $this->rules += ['image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',];
        $this->rules += ['image_flag' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',];
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
