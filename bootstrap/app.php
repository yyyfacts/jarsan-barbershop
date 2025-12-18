<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // --- PERBAIKAN DI SINI ---
        // Daftarkan alias 'is_admin' yang mengarah ke file Middleware kamu
        $middleware->alias([
            'is_admin' => \App\Http\Middleware\IsAdmin::class, // Pastikan path ini benar
        ]);
        
        // Trust Proxies (Wajib untuk Vercel/Https)
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();