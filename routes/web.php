<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminController; // Pastikan buat controller ini nanti

// ====================================================
// 1. HALAMAN PUBLIK (Tamu / Belum Login)
// ====================================================

// Landing Page Utama
Route::get('/', function () {
    return view('welcome'); // Halaman pilihan (Login / Tamu)
})->name('welcome');

// Halaman Home Website
Route::get('/home', function () {
    return view('home');
})->name('home');

// Halaman Statis
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
// 3. HALAMAN USER (Harus Login sebagai User Biasa)
// ====================================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', function () {
        // Cek jika admin nyasar ke sini, lempar ke admin
        if(auth()->user()->email == 'admin@jarsan.com') {
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    // Halaman Reservasi (Hanya user login yang bisa booking)
    Route::get('/reservasi', function () {
        return view('reservasi');
    })->name('reservasi');
    
    // Proses Kirim Reservasi (Nanti buat controller ini)
    // Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservasi.store');
});


// ====================================================
// 4. HALAMAN ADMIN (Harus Login sebagai Admin)
// ====================================================
// Kita gunakan middleware closure sederhana untuk cek email admin
Route::middleware(['auth', function ($request, $next) {
    if (auth()->user()->email !== 'admin@jarsan.com') {
        return redirect('/dashboard'); // Tendang user biasa balik ke dashboard mereka
    }
    return $next($request);
}])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manajemen Layanan (Services)
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    
    // Manajemen Reservasi
    Route::get('/reservations', function () {
        return view('admin.reservations');
    })->name('reservations');

    // Pesan Masuk
    Route::get('/contacts', function () {
        return view('admin.contacts');
    })->name('contacts');

});