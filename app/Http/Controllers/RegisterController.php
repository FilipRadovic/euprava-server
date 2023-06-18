<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request
            ->validate([
            'firstname' => 'bail|required|max:30',
            'lastname' => 'bail|required|max:30',
            'email' => 'bail|required|email',
            'jmbg' => 'bail|required|digits:13',
            'username' => 'bail|required|max:30',
            'password' => [
                'bail',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'city' => 'bail|required|integer',
            'document.type' => 'bail|required|integer',
            'document.number' => 'bail|required|max:255',
        ], [ "stopOnFirstFailure" => true]);
    }
}
