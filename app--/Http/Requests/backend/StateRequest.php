<?php

namespace App\Http\Requests\backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class StateRequest extends FormRequest
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
      //  $this->rules += ['price' => 'required'];
        $this->rules += ['city_id' => 'required'];
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => 'required|unique:state_translations,title'];
        } // end of  for each
        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('state');
       // $this->rules += ['price' => 'required'];
        $this->rules += ['city_id' => 'required'];
        //     dd($item);
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('state_translations', 'title')->ignore($item->id, 'state_id')]];
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
