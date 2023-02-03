<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    
    public function rules()
    {
        return [
            'email'=>'string|required|exists:users,email',
            'password'=>'required|string|min:4'
        ];
    }
}
