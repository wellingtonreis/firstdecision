<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:20|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O campo nome deve ter no máximo 50 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um email válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'O campo senha deve ter no mínimo 6 caracteres.',
            'password.max' => 'O campo senha deve ter no máximo 20 caracteres.',
            'password.confirmed' => 'O campo senha não confere com a confirmação de senha.',
        ];
    }
}
