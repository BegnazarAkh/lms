<?php
// app/Actions/Fortify/CreateNewUser.php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use \Laravel\Fortify\Rules\PasswordValidationRules;

    /**
     * Validate & create a new user.
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name'                  => ['required','string','max:255'],
            'email'                 => ['required','email','max:255','unique:users'],
            'role'                  => ['required','in:student,teacher'],
            'password'              => $this->passwordRules(),
            'password_confirmation' => ['required','same:password'],
        ])->validate();

        return User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'role'     => $input['role'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
