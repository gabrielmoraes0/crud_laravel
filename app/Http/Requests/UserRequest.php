<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Erro de validação',
            'errors' => $validator->errors(),
        ], 422));
    }   


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return[
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $this->user->id,
        'password' => 'nullable|min:6',
        ];
        
    }

    public function messages(): array
    {
        return[
            'name.required' => 'O Campo nome é obrigatório.',
            'email.required' => 'O Campo email é obrigatório.',
            'email.email' => 'Necessário enviar o e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'O Campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
        ];
    }

}
