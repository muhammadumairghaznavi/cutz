<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            $this->rules += [$locale . '.title' => 'required'];
            // $this->rules += [$locale . '.title' => 'required|unique:category_translations,title'];
        } // end of  for each
        $this->rules += [
            'image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',
            'section_id' => 'required',
        ];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('category');
        foreach (config('translatable.locales') as $locale) {
            // $this->rules += [$locale . '.title' => ['required', Rule::unique('category_translations', 'title')->ignore($item->id, 'category_id')]];
            $this->rules += [$locale . '.title' => ['required']];
        } // end of  for each

        $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png,jpg|max:2048',  'section_id' => 'required',];

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'section_id.required' => 'أدخل القسم ',
        ];
        return $msg;
    }
}
