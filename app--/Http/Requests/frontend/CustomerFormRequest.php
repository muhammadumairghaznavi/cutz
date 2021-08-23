<?php

namespace App\Http\Requests\frontend;

use App\Rules\CheckEmailExist;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerFormRequest extends FormRequest
{
    public $rules = [
        'full_name' => 'required|string|max:255',
        'gender' => 'required|in:male,female',
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
            'email' => 'required|unique:customers,email',
            'phone' => 'required|unique:customers',
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'same:password', 'min:6'],
            'image' =>  'image:mimes:jpeg,bmp,png|max:2048',
        ];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('customer');
        $this->rules += [
            'email' => ['required', Rule::unique('customers', 'email')->ignore($item->id, 'id')],
            'phone' => 'required|unique:customers,phone,' . $item->id,
            'image' =>  'image:mimes:jpeg,bmp,png|max:2048',
        ];
        return $this->rules;
    }
}
