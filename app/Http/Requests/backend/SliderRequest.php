<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    public $rules = [
        'image' => 'required|image:mimes:jpeg,bmp,png|max:2048',
    ];
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => 'required'];
            $this->rules += [$locale . '.description' => 'nullable|sometimes'];
        } // end of  for each
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
        return $rules  = ['image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',];
    }
    public function messages()
    {
        $msg = [
            //'image.required' => __('message.image'),
        ];
        return $msg;
    }
}
