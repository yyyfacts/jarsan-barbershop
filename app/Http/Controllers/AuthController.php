<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite; // WAJIB ADA
use Illuminate\Support\Str; // WAJIB ADA

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
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada berdasarkan email
            $finduser = User::where('email', $googleUser->getEmail())->first();

            if ($finduser) {
                // Jika user ada, update google_id jika belum punya
                if (empty($finduser->google_id)) {
                    $finduser->update(['google_id' => $googleUser->getId()]);
                }
                
                Auth::login($finduser);

                // Cek Admin atau User Biasa
                if (Auth::user()->email === 'admin@jarsan.com') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('welcome');

            } else {
                // Jika user belum ada, buat baru
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)) // Password acak
                ]);

                Auth::login($newUser);
                return redirect()->route('welcome');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Gagal login dengan Google.']);
        }
    }

    // --- LOGIN FORM ---
    public function showLoginForm() {
        if (Auth::check()) {
            if (Auth::user()->email === 'admin@jarsan.com') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('welcome');
        }
        return view('auth.login');
    }

    // --- PROSES LOGIN BIASA ---
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            if (Auth::user()->email === 'admin@jarsan.com') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('welcome');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    // --- REGISTER FORM ---
    public function showRegisterForm() {
        return view('auth.register');
    }

    // --- PROSES REGISTER BIASA ---
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

    // --- LOGOUT ---
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}