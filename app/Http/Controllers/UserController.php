<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function getSignUpForm()
    {
        return view('signUpForm');
    }
    public function getLoginForm()
    {
        return view('loginForm');
    }

    public function getProfile()
    {
        $user = Auth::user();
        return view('profileForm', ['user' => $user]);
    }

    public function signUp(SignUpRequest $request)
    {
        $data = $request->all();

        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->redirectTo('/login');
    }

    public function login(LoginRequest $request)
    {
        Auth::attempt([
            'email'=>$request->get('email'),
            'password'=>$request->get('password')
        ]);

        return response()->redirectTo('/catalog');
    }


}
