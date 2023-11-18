<?php

namespace App\Http\Requests\Users;

use App\Rules\ExistClientRule;
use App\Rules\ExistUsersRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UsersEditFormRequest extends FormRequest
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
            'id' => [
                'required',
                'integer', /* 'exists:users' */
                new ExistUsersRule($this->id)
            ],
        ];
    }


    public function messages()
    {
        return [
            'id.required' => "é obrigatório enviar um id",
            'id.integer' => "é obrigatório que seja um inteiro",
        ];
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $id = $this->id;

        $this->merge([
            'id' => $id
        ]);
    }


    /**
     * Caso a validação falhe, retorna os itens de erro
     *
     * @return Json
     */
    protected function failedValidation(Validator $validator)
    {
        abort(404);
    }
}
