<?php

namespace App\Http\Requests\Api;

use App\Traits\APIRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerFormRequest extends APIRequest
{
    public $rules = [];

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        $this->rules += [
            'full_name' => 'required|string|max:200',
            'gender' => 'required|in:male,female',
            'deviceType' => "required|in:ios,android",
            'phone' => 'required|unique:customers,phone',
            'email' => 'required|unique:customers,email',


        ];
        return $this->rules;
    }
}
