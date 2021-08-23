<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;


class CountryRequest extends FormRequest
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
            $this->rules += [$locale . '.title' => 'required|unique:country_translations,title'];
        } // end of  for each
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('country');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('country_translations', 'title')->ignore($item->id, 'country_id')]];
        } // end of  for each
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
