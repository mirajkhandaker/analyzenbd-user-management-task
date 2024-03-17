<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('users.index');
        }

        session()->flash('error','Invalid credentials.');
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->back();
    }
}
