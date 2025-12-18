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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // LOGIKA: Kalau user yang login BUKAN 'admin@jarsan.com', tendang ke dashboard biasa
        if (Auth::check() && Auth::user()->email !== 'admin@jarsan.com') {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}