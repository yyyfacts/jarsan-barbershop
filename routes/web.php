<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Semua Controller
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BarberController;

// ====================================================
// 1. HALAMAN PUBLIK
// ====================================================
Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/barberman', [PublicController::class, 'barberman'])->name('barberman');
Route::get('/pricelist', [PublicController::class, 'pricelist'])->name('pricelist');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ====================================================
// 2. AUTHENTICATION (Login, Register, Google)
// ====================================================

Route::middleware('guest')->group(function () {
    // Login Biasa
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    
    // Register Biasa
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    // Login Google
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================================================
// 3. HALAMAN USER
// ====================================================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->email === 'admin@jarsan.com') {
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservasi');
    Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservasi.store');
});

// ====================================================
// 4. HALAMAN ADMIN
// ====================================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Services
    Route::get('/services', [ServiceController::class, 'adminIndex'])->name('services');       
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');     
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update'); 
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy'); 

    // Barbers
    Route::get('/barbers', [BarberController::class, 'index'])->name('barbers.index');         
    Route::post('/barbers', [BarberController::class, 'store'])->name('barbers.store');        
    Route::put('/barbers/{id}', [BarberController::class, 'update'])->name('barbers.update');  
    Route::delete('/barbers/{id}', [BarberController::class, 'destroy'])->name('barbers.destroy'); 
    
    // About
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');

    // Reservations
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::put('/reservations/{id}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    
    // Contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});