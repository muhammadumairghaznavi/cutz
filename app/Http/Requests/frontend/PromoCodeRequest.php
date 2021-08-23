<?php

namespace App\Http\Requests\frontend;

use App\PromoCode;
use Illuminate\Foundation\Http\FormRequest;

class PromoCodeRequest extends FormRequest
{
    public $rules = [];

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

            'code' => ['bail', 'required', function ($attribute, $value, $fail) {

                $code = PromoCode::where('code', request()->code)->first();

                if ($code == null) {
                    $fail(__('site.Promocode Not Found'));
                } else {
                    #if expired
                    if ($code->endDate < date("Y-m-d") || $code->status == 'notActive') {
                        $fail(__('site.Promocode Expired'));
                    }
                }
            }],

        ];

        return $this->rules;
    }

    public function updateRules()
    {
    }


    public function messages()
    {
        $msg = [
            'code.required' => __('validation.code'),
        ];
        return $msg;
    }
}
