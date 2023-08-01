<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'value' => 'required|numeric|min:0',
            'description' => 'required|max:191',
            'user_id' => 'required|exists:users,id',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'A descrição é necessária.',
            'value.min' => 'O valor não pode ser negativo.',
        ];
    }

    protected function failedValidation(Validator $validator) 
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
