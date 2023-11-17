<?php

namespace App\Http\Requests\Users;

use App\Models\Users;
use Illuminate\Foundation\Http\FormRequest;

class UsersAddFormRequest extends FormRequest
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
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "é obrigatório enviar um nome",
            'name.string' => "é obrigatório que seja um texto",
            'email.required' => "é obrigatório enviar um email",
            'email.string' => "é obrigatório que seja um email valido",
            'password.required' => "é obrigatório enviar uma senha",
        ];
    }
}
