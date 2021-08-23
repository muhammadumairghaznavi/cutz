<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
{
    public $rules = [
        'price_egy_monthly' => 'required|numeric|gt:0',
        'offer_egy_monthly' => 'numeric|lt:price_egy_monthly',

        'price_egy_yearly' => 'nullable| numeric|gt:0',
        'offer_egy_yearly' => 'nullable| numeric|lt:price_egy_yearly',

        'price_dollar_monthly' => 'nullable| numeric',
        'offer_dollar_monthly' => 'nullable| numeric|lt:price_dollar_monthly',

        'price_dollar_yearly' => 'nullable| numeric',
        'offer_dollar_yearly' => 'nullable| numeric|lt:price_dollar_yearly',

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
            $this->rules += [$locale . '.title' => 'required|unique:package_translations,title'];
        } // end of  for each
        $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('package');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('package_translations', 'title')->ignore($item->id, 'package_id')]];
        } // end of  for each

        $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',];

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'price_egy_monthly.numeric' => 'لا بد ان يكون رقما',
            'price_egy_yearly.numeric' => 'لا بد ان يكون رقما ',
            'offer_egy_monthly.numeric' => 'لا بد ان يكون رقما ',
            'offer_egy_yearly.numeric' => 'لا بد ان يكون رقما ',
            'price_dollar_monthly.numeric' => 'لا بد ان يكون رقما ',
            'offer_dollar_monthly.numeric' => 'لا بد ان يكون رقما ',
            'price_dollar_yearly.numeric' => 'لا بد ان يكون رقما ',
            'offer_dollar_yearly.numeric' => 'لا بد ان يكون رقما ',
            //////////////

            'price_egy_monthly.required' => 'مطلوب',

            ////////////

            // 'price_egy_monthly.max' => ' يجب أن تكون قيمة  مساوية أو أصغر لـ 11',
            // 'price_egy_yearly.max' => '  يجب أن تكون قيمة  مساوية أو أصغر لـ 11',
            // 'offer_egy_monthly.max' => '  يجب أن تكون قيمة  مساوية أو أصغر لـ 11',
            // 'offer_egy_yearly.max' => ' يجب أن تكون قيمة  مساوية أو أصغر لـ 11 ',
            // 'price_dollar_monthly.max' => '  يجب أن تكون قيمة  مساوية أو أصغر لـ 11',
            // 'offer_dollar_monthly.max' => ' يجب أن تكون قيمة  مساوية أو أصغر لـ 11 ',
            // 'price_dollar_yearly.max' => ' يجب أن تكون قيمة  مساوية أو أصغر لـ 11 ',
            // 'offer_dollar_yearly.max' => '  يجب أن تكون قيمة  مساوية أو أصغر لـ 11',
            ////////////


            'offer_egy_monthly.lt' => ' غير منطقي ان يكون الخصم اكبر من السعر الاساسي !',
            'offer_egy_yearly.lt' => 'غير منطقي ان يكون الخصم اكبر من السعر الاساسي ! ',

            'offer_dollar_monthly.lt' => 'غير منطقي ان يكون الخصم اكبر من السعر الاساسي ! ',

            'offer_dollar_yearly.lt' => ' غير منطقي ان يكون الخصم اكبر من السعر الاساسي !',
            ////
            'price_egy_monthly.gt' => 'اكبر من الصفر',
            'price_egy_yearly.gt' => 'اكبر من الصفر',





        ];
        return $msg;
    }
}
