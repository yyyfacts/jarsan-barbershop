<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // TAMPILKAN FORM LOGIN
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cek apakah email & password cocok di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Kalau cocok, arahkan ke dashboard
            return redirect()->intended('dashboard');
        }

        // 4. Kalau salah, balikin ke login dengan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // TAMPILKAN FORM REGISTER
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // PROSES REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Langsung login setelah daftar
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
             return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}