<?php
namespace App\Http\Requests\backend;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class TagRequest extends FormRequest
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
            $this->rules += [$locale . '.title' => 'required|unique:tag_translations,title,' . $this->id];
        } // end of  for each
        return $this->rules;
    }
    public function updateRules()
    {
        $tag = $this->route('tag');
        foreach (config('translatable.locales') as $locale) {
            $this->rules += [$locale . '.title' => ['required', Rule::unique('tag_translations', 'title')->ignore($tag->id, 'tag_id')]];
        } // end of  for each
        return $this->rules;
    }
    public function messages()
    {
        $msg = [
            'service_id.required' => __('اختار الخدمة'),
        ];
        return $msg;
    }
}
