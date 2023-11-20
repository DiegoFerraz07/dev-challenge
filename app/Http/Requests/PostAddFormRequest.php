<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostAddFormRequest extends FormRequest
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
            'comments' => 'required|string|max:280',
        ];
    }

    public function messages()
    {
        return [
            'comments.required' => "é obrigatório enviar um texto",
            'comments.string' => "é obrigatório que seja um texto",
        ];
    }
}
