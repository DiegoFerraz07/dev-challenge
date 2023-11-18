<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'=> 'required|integer',
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=> 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => "é obrigatório enviar o id",
            'id.integer' => "é obrigatório que seja um número",
            'name.required' => "é obrigatório enviar um nome",
            'name.string' => "é obrigatório que seja um texto",
            'email.required' => "é obrigatório enviar um email",
            'email.string' => "é obrigatório que o email seja um texto",
            'password.required' => "é obrigatório enviar um password",
            'password.string' => "é obrigatório que o password"
        ];
    }
}
