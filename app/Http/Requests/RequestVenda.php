<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestVenda extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'O campo user_id é obrigatório.',
            'user_id.integer'  => 'O user_id deve ser um número inteiro.',
            'user_id.exists'   => 'O usuário não existe no sistema.',
        ];
    }
}
