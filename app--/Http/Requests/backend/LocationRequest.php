<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest
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
            $this->rules += [$locale . '.title' => 'required|unique:location_translations,title'];
        } // end of  for each
        $this->rules += [

        ];
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('location');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('location_translations', 'title')->ignore($item->id, 'location_id')]];
        } // end of  for each

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
           // 'section_id.required' => 'أدخل القسم ',
        ];
        return $msg;
    }
}
