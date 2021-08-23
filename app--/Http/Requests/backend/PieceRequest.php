<?php

namespace App\Http\Requests\backend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PieceRequest extends FormRequest
{
    public $rules = [


        'category_id' => 'required',

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
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => 'required|unique:piece_translations,title'];
        } // end of  for each

        return $this->rules;
    }
    public function updateRules()
    {
        $item = $this->route('piece');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('piece_translations', 'title')->ignore($item->id, 'piece_id')]];
        } // end of  for each

        //$this->rules += ['image' => 'nullable|image:mimes:jpeg,bmp,png,jpg|max:2048',  'category_id' => 'required',];

        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'category_id.required' => 'أدخل الصنف ',


        ];
        return $msg;
    }
}
