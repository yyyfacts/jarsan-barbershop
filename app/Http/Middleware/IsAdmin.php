<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek: Apakah sudah login? DAN Apakah emailnya admin?
        if (Auth::check() && Auth::user()->email === 'admin@jarsan.com') {
            return $next($request);
        }

        // Jika dia User Biasa mencoba masuk halaman Admin, tendang ke Dashboard User
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('error', 'Anda bukan Admin!');
        }

        // Jika belum login sama sekali, tendang ke Login
        return redirect()->route('login');
    }
}