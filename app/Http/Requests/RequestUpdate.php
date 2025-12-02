<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdate extends FormRequest
{
        public function rules()
{
    return [
        'nome_de_usuario' => 'sometimes|string|min:3',
        'email' => 'sometimes|email',
        'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&.,:;_\-])[A-Za-z\d@$!%*#?&.,:;_\-]+$/'
            ],
    ];
}


   
}
