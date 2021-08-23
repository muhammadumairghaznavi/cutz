<?php

namespace App\Http\Requests\backend;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;
use PHPUnit\Framework\Constraint\IsTrue;

class PlanRequest extends FormRequest
{
    //   price_egy offer_egy price_usd offer_usd time_period
    public $rules = [
        'price_egy' => 'required|numeric',
        'offer_egy' => 'nullable|numeric|lt:price_egy',
        'price_usd' => 'nullable|numeric',
        'offer_usd' => 'nullable|numeric|lt:price_usd',
        'time_period' => 'required',
        'service_id' => 'required',
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
            $this->rules += [$locale . '.title' => 'required|unique:plan_translations,title,' . $this->id];
            $this->rules += [$locale . '.description' => 'required'];
        } // end of  for each
        // $this->rules += ['image' => 'required|image:mimes:jpeg,bmp,png|max:2048,' . $this->id];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('plan');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', ValidationRule::unique('plan_translations', 'title')->ignore($item->id, 'plan_id')]];
        } // end of  for each
        //   $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048,' . $item->id];
        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'service_id.required' => __('اختار الخدمة'),
            'price_egy.numeric' => __('تأكد من نمط كتابة الاسعار '),
            'offer_egy.numeric' => __('تأكد من نمط كتابة الاسعار '),
            'offer_egy.lt' => __('  سعر الخصم المصري :ليس منطقيا ان يكون سعر الخصم اكبر من او يساوي  السعر الاساسي'),
            'price_usd.numeric' => __('تأكد من نمط كتابة الاسعار '),
            'offer_usd.numeric' => __('تأكد من نمط كتابة الاسعار '),
            'offer_usd.lt' => __(' سعر الخصم الاجنبي : ليس منطقيا ان يكون سعر الخصم اكبر من او يساوي  السعر الاساسي'),
            'time_period.required' => __('ضف الفترة المسموحة '),
        ];
        return $msg;
    }
}
