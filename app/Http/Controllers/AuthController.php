<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- TAMPILKAN FORM LOGIN ---
    public function showLoginForm() {
        // Jika user sudah login, langsung lempar ke tujuannya
        if (Auth::check()) {
            if (Auth::user()->email === 'admin@jarsan.com') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('welcome');
        }
        return view('auth.login');
    }

    // --- PROSES LOGIN ---
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // CEK SIAPA YANG LOGIN?
            if (Auth::user()->email === 'admin@jarsan.com') {
                // Jika Admin -> Ke Dashboard Admin
                return redirect()->route('admin.dashboard');
            }

            // PERUBAHAN DISINI:
            // Jika User Biasa -> Ke Halaman Beranda (Welcome)
            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // --- TAMPILKAN FORM REGISTER ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    // --- PROSES REGISTER ---
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // --- PROSES LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Setelah logout, kembali ke halaman utama (Beranda)
        return redirect()->route('welcome');
    }
}