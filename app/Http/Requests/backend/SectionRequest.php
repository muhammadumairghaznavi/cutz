<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
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
            $this->rules += [$locale . '.title' => 'required|unique:section_translations,title'];
        } // end of  for each
        $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('section');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('section_translations', 'title')->ignore($item->id, 'section_id')]];
        } // end of  for each

        $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png,jpg|max:2048',];

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            //'image.required' => __('message.image'),
        ];
        return $msg;
    }
}
