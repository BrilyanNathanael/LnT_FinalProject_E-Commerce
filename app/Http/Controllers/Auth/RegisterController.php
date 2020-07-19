<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = array(
            'name.required' => 'Harap masukkan nama Anda.',
            'name.min' => 'Harap masukkan nama minimal 3 karakter.',
            'name.max' => 'Harap masukkan nama tidak lebih dari 40 karakter.',
            'email.required' => 'Harap masukkan email Anda.',
            'email.unique' => 'Email ini sudah terdaftar, harap gunakan Email yang lain.',
            'no_hp.required' => 'Harap masukkan nomor HP Anda.',
            'password.required' => 'Harap masukkan password Anda.',
            'password.min' => 'Harap masukkan password minimal 6 karakter.',
            'password.max' => 'Harap masukkan password tidak lebih dari 12 karakter.',
            'password.confirmed' => 'Harap masukkan password yang sesuai.',
            'email.regex' => 'Harap masukkan email dengan "format@gmail.com"',
            'no_hp.regex' => 'Harap masukkan nomor hp yang diawali "08"',
        );
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:/[a-zA-Z0-9]+\@gmail.com/'],
            'no_hp' => ['required', 'regex:/08[0-9]+/'],
            'password' => ['required', 'string', 'min:6', 'max:12', 'confirmed'],
        ],$message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'id_admin' => 0,
            'name' => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
