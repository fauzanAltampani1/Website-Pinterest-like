<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

       

        // Menyimpan data pengguna baru
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // Validasi input dari pengguna
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Ambil kredensial dari input pengguna
    $credentials = $request->only('email', 'password');

    // Coba autentikasi
    if (!Auth::attempt($credentials)) {
        session()->flash('error', 'Email atau password yang Anda masukkan salah.');
        return redirect()->back();
    }

    // Jika berhasil, arahkan ke halaman dashboard (contoh)
    return redirect()->route('home');
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}