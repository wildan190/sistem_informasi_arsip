<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan form login
    public function loginForm()
    {
        return view('cms.pages.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validasi input
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Login berhasil, redirect ke halaman dashboard atau yang diinginkan
            return redirect()->route('dashboard');
        } else {
            // Login gagal, kembali ke halaman login dengan pesan error
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    // Menampilkan form register
    public function registerForm()
    {
        return view('cms.pages.auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $data = $request->only('name', 'email', 'password', 'password_confirmation');

        // Validasi input
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create user
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Setelah register, arahkan ke halaman login atau login otomatis
        return redirect()->route('login')->with('success', 'Registration successful, please log in.');
    }

    // Logout
    public function logout()
    {
        // Logout user
        Auth::logout();

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Successfully logged out');
    }
}
