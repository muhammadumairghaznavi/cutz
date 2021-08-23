<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{

    public $rules = [

        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'message' => 'required',
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

        $this->rules += [
            'result' => ['required', function ($attribute, $value, $fail) {

                if (request('num1') + request('num2')  != request('result')) {
                    $msg = "ناتج الجمع خطأ!";
                    if ($msg) {
                        $fail($msg);
                    }
                }
            }],

        ];
        return $this->rules;
    }
    public function updateRules()
    {
        //$this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',];
        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'name.required' => __('validation.name'),
            'phone.required' => __('validation.phone'),
            'email.required' => __('validation.email'),
            'message.required' => __('site.message'),
            'result.required' => __('ادخل حاصل الجمع'),
        ];
        return $msg;
    }
}
