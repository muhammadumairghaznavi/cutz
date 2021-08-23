<?php

namespace App\Http\Requests\backend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InstructionRequest extends FormRequest
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
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => 'required|unique:instruction_translations,title'];
        } // end of  for each
        $this->rules += [
            'image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',
            'product_id' => 'required',
        ];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('instruction');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('instruction_translations', 'title')->ignore($item->id, 'instruction_id')]];
        } // end of  for each

        $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png,jpg|max:2048',  'product_id' => 'required',];

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'product_id.required' => 'أدخل product_id ',
        ];
        return $msg;
    }
}
