<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // LOGIKA PENGECEKAN:
        // Kalau dia BUKAN admin, tendang balik ke dashboard user biasa
        if (Auth::check() && Auth::user()->email !== 'admin@jarsan.com') {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}