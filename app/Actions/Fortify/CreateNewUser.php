<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\AlphaDashDot;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:4', 'max:16', 'unique:users', new AlphaDashDot],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ], [
            'username.regex' => 'username hanya boleh berisi huruf, angka, titik(.), tanda hubung(-) dan garis bawah(_).',
            'username.unique' => 'username telah terdaftar.',
            'email.unique' => 'email telah terdaftar.',
            'terms.required' => 'anda harus setuju dengan Ketentuan Layanan dan Kebijakan Privasi kami untuk menggunakan situs ini.'
        ])->validate();
        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
