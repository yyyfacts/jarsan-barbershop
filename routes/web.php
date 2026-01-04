<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- IMPORT SEMUA CONTROLLER ---
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes - Jarsan Barbershop
|--------------------------------------------------------------------------
*/

// ====================================================
// 1. HALAMAN PUBLIK (Bisa diakses siapa saja)
// ====================================================
Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::get('/about', [AboutController::class, 'index'])->name('about'); 
Route::get('/barberman', [BarberController::class, 'index'])->name('barberman');
Route::get('/pricelist', [PublicController::class, 'pricelist'])->name('pricelist');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// ====================================================
// 2. AUTHENTICATION (Login & Register)
// ====================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');

    // Google Auth
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================================================
// 3. HALAMAN USER (Harus Login)
// ====================================================
Route::middleware(['auth'])->group(function () {

    // Dashboard User & Redirection Logic
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') { 
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    // --- RESERVASI BOOKING SYSTEM (UPDATED) ---
    Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservasi');
    Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservasi.store');
    
    // Fitur Cek Slot Terboking (AJAX) - Untuk membuat jam jadi merah/disabled
    Route::get('/reservasi/check-slots', [ReservationController::class, 'checkSlots'])->name('reservasi.check-slots');
    
    // Fitur Riwayat Reservasi - Agar user bisa cek status "Pending/Approved" langsung
    Route::get('/reservasi/history', [ReservationController::class, 'history'])->name('reservasi.history');

    // Edit Profile User
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Kirim Review/Ulasan
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');
});


// ====================================================
// 4. HALAMAN ADMIN (Harus Login & Role Admin)
// ====================================================
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // --- MANAJEMEN LAYANAN (SERVICES) ---
    Route::get('/services', [ServiceController::class, 'adminIndex'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // --- MANAJEMEN BARBER (TIM & JADWAL) ---
    Route::get('/barbers', [BarberController::class, 'indexAdmin'])->name('barbers.index');
    Route::post('/barbers', [BarberController::class, 'store'])->name('barbers.store');
    Route::put('/barbers/{id}', [BarberController::class, 'update'])->name('barbers.update');
    Route::delete('/barbers/{id}', [BarberController::class, 'destroy'])->name('barbers.destroy');

    // --- MANAJEMEN ABOUT US (TENTANG KAMI) ---
    Route::get('/about', [AboutController::class, 'edit'])->name('about.index');
    Route::put('/about', [AboutController::class, 'update'])->name('about.update');

    // --- MANAJEMEN RESERVASI ---
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/export', [ReservationController::class, 'exportExcel'])->name('reservations.export');
    Route::put('/reservations/{id}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // --- MANAJEMEN PESAN KONTAK & INFO ---
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index'); 
    Route::post('/contact/update', [ContactController::class, 'updateDetails'])->name('contact.update');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // --- PENGATURAN WEBSITE (SETTINGS LAINNYA) ---
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

});