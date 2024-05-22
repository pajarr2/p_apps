<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class DefaultController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Optionally, log the user in after registration
        Auth::login($user);

        return redirect('/dashboard')->with(['registerSuccess' => 'Selamat datang!']);
    }

    public function authanticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with(['loginSuccess' => 'Selamat Datang Kembali!']);
        }

        return back()->with(['error' => 'Email atau Passoword tidak sesuai!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
