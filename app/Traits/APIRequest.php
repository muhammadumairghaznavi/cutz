<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class APIRequest extends FormRequest
{
    /**
     * Determine if user authorized to make this request
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        // $response = [
        //     'data' => null,
        //     'status' => false,
        //     'error' => $error,
        // ];

        throw new HttpResponseException(response()->json(['data' => null, 'status' => false, 'error' => $validator->errors()->first()], 422));
    }
    abstract public function rules();
}
