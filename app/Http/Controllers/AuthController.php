<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- LOGIN ---
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // 3. Cek Siapa yang Login?
            $user = Auth::user();

            if ($user->email === 'admin@jarsan.com') {
                // Jika Admin -> Ke Dashboard Admin
                return redirect()->route('admin.dashboard');
            }

            // Jika User Biasa -> Ke Dashboard User
            return redirect()->route('dashboard');
        }

        // 4. Jika Gagal (Password/Email Salah)
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // --- REGISTER ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Simpan User Baru dengan Password Hash
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // PENTING: Hash Password
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // --- LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}