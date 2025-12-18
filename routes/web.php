<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;

// ====================================================
// 1. PENGATURAN HALAMAN AWAL
// ====================================================

// Halaman Root (/) langsung lempar ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login & Register (Hanya untuk tamu)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

// Logout (Bisa diakses siapa saja yang login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================================================
// 2. HALAMAN USER (Pelanggan)
// ====================================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', function () {
        // Proteksi: Jika admin nyasar ke sini, lempar ke dashboard admin
        if(auth()->user()->email == 'admin@jarsan.com') {
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    // Halaman-halaman User
    Route::get('/reservasi', function () { return view('reservasi'); })->name('reservasi');
    Route::get('/home', function () { return view('home'); })->name('home');
    Route::get('/about', function () { return view('about'); })->name('about');
    Route::get('/barberman', function () { return view('barberman'); })->name('barberman');
    Route::get('/pricelist', function () { return view('pricelist'); })->name('pricelist');
    Route::get('/contact', function () { return view('contact'); })->name('contact');
});


// ====================================================
// 3. HALAMAN ADMIN
// ====================================================
// Pastikan Middleware 'is_admin' sudah didaftarkan di bootstrap/app.php
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Controller Layanan
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    
    // View Static Admin
    Route::get('/reservations', function () { return view('admin.reservations'); })->name('reservations');
    Route::get('/contacts', function () { return view('admin.contacts'); })->name('contacts');
});