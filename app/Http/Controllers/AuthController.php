<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // --- 1. GOOGLE LOGIN: REDIRECT ---
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // --- 2. GOOGLE LOGIN: CALLBACK ---
    public function handleGoogleCallback()
    {
        try {
            // Menggunakan stateless() agar lebih stabil di beberapa hosting
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek user berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Jika user sudah ada, update datanya
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar_blob' => $googleUser->getAvatar(),
                ]);
            } else {
                // Jika user belum ada, BUAT BARU
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar_blob' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)), // Password acak agar database tidak menolak
                    'role' => 'user' // Google login defaultnya user
                ]);
            }

            // Login-kan User
            Auth::login($user);

            // Google Login PASTI User biasa, jadi lempar ke Dashboard User
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            // Jika error, tampilkan pesan errornya (biar ketahuan kenapa mental)
            return redirect()->route('login')->with('error', 'Login Google Gagal: ' . $e->getMessage());
        }
    }

    // --- 3. LOGIN FORM ---
    public function showLoginForm() {
        if (Auth::check()) {
            // Cek manual email admin
            if (Auth::user()->email === 'admin@jarsan.com') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    // --- 4. PROSES LOGIN MANUAL (Khusus Admin & User yg punya password) ---
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // LOGIKA KHUSUS ADMIN
            if (Auth::user()->email === 'admin@jarsan.com') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // --- 5. REGISTER FORM (Untuk User Biasa) ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    // --- 6. PROSES REGISTER ---
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
            'role' => 'user'
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // --- 7. LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}