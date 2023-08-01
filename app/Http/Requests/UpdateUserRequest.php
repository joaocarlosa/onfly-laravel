<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'O nome foi atualizado com sucesso!',
            'password.confirmed' => 'A senha foi atualizada com sucesso!',
        ];
    }
}

