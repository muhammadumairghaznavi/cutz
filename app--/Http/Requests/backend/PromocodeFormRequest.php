<?php

namespace App\Http\Requests\backend;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PromocodeFormRequest extends FormRequest
{
    public $rules = [
        'status' => ['required', 'in:"active","notActive"'],

        'endDate' => ['required', 'date', 'after:yesterday'],
        //  'startTime' => ['nullable', 'date_format:H:i',],
        'type' => ['required', 'in:percent,amount'],
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
            'code' => ['required', 'max:30', 'unique:promo_codes'],
            'discount_amount' => ['required', 'integer', function ($attribute, $value, $fail) {
                if (request()->type == 'percent' && request()->discount_amount > 100) {
                    $fail(__('site.Discount percent Must Not Excesed 100'));
                }
            }],
            'startDate' => ['required', 'date', function ($attribute, $value, $fail) {
                $msg = $this->validateDateTime();
                if ($msg) {
                    $fail($msg);
                }
            }],
        ];
        return $this->rules;
    }
    public function updateRules()
    {
        $promocode = $this->route('promocode');

        //      dd($promocode->id);
        $this->rules += [
            'code' => ['required', 'max:30',  Rule::unique('promo_codes', 'code')->ignore($promocode->id, 'id')],
            // 'code' => ['required',   Rule::unique('promo_codes', 'code')],
            'discount_amount' => ['required', 'integer', function ($attribute, $value, $fail) {
                if (request()->type == 'percent' && request()->discount_amount > 100) {
                    $fail(__('site.Discount percent Must Not Excesed 100'));
                }
            }],
            'startDate' => ['required', 'date', function ($attribute, $value, $fail) {
                $msg = $this->validateDateTime();
                if ($msg) {
                    $fail($msg);
                }
            }],
        ];
        return $this->rules;
    }
    public function validateDateTime()
    {

        $msg = '';
        $startDate = request('startDate');
        $endDate = request('endDate');
        if ($startDate < date("Y-m-d") || $endDate < date("Y-m-d")) {
            $msg  = __('site.Date Should Be In Present');
        }
        return $msg;
    }
}
