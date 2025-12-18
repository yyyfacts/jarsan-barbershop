<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;

// ====================================================
// 1. HALAMAN PUBLIK (BISA DIBUKA SIAPA SAJA)
// ====================================================

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Halaman Statis Lainnya
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/barberman', function () { return view('barberman'); })->name('barberman');
Route::get('/pricelist', function () { return view('pricelist'); })->name('pricelist');
Route::get('/contact', function () { return view('contact'); })->name('contact');


// ====================================================
// 2. AUTHENTICATION (Login & Register)
// ====================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================================================
// 3. HALAMAN USER (Harus Login)
// ====================================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', function () {
        // Cek jika admin nyasar, lempar ke dashboard admin
        if(auth()->user()->email == 'admin@jarsan.com') {
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    // Halaman Reservasi (WAJIB LOGIN)
    Route::get('/reservasi', function () {
        return view('reservasi');
    })->name('reservasi');
});


// ====================================================
// 4. HALAMAN ADMIN (Harus Login & Email Admin)
// ====================================================
// Pastikan Middleware 'is_admin' sudah didaftarkan di bootstrap/app.php
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // CRUD Layanan
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    
    Route::get('/reservations', function () { return view('admin.reservations'); })->name('reservations');
    Route::get('/contacts', function () { return view('admin.contacts'); })->name('contacts');
});