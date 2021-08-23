<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            $this->rules += [$locale . '.title' => 'required|unique:blogs_translations,title'];
            $this->rules += [$locale . '.description' => 'required'];
        } // end of  for each

        $this->rules += ['image' => 'required|image:mimes:jpeg,bmp,png|max:2048',];
        return $this->rules;
    }
    public function updateRules()
    {
        $blog = $this->route('blog');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('blogs_translations', 'title')->ignore($blog->id, 'blogs_id')]];
            $this->rules += [$locale . '.description' => 'required'];
        } // end of  for each
        $this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png|max:2048',];

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
