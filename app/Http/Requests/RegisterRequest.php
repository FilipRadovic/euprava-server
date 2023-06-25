<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname' => ['required', 'max:30'],
            'lastname' => ['required', 'max:30'],
            'email' => ['required', 'email'],
            'jmbg' => ['required', 'digits:13'],
            'username' => ['required', 'max:30'],
            'password' => [
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'city_id' => ['required', 'integer'],
            'document.type_id' => ['required', 'integer'],
            'document.number' => ['required', 'max:255']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
