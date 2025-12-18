<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarberController; // (Buat controller ini opsional mirip ServiceController)

// --- HALAMAN PUBLIK ---
Route::get('/', function () { return redirect()->route('login'); }); // Redirect root ke login sesuai request awal
Route::get('/welcome', function () { return view('welcome'); })->name('welcome');

// Halaman Dinamis (Ambil dari DB)
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/pricelist', [ServiceController::class, 'index'])->name('pricelist');
Route::get('/contact', function () { return view('contact'); })->name('contact'); // View form kontak
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store'); // Proses kirim pesan

// Halaman Statis (Barberman bisa dibuat dinamis nanti)
Route::get('/barberman', function () { return view('barberman'); })->name('barberman');


// --- AUTH ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- USER AREA ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if(auth()->user()->email == 'admin@jarsan.com') {
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    // Reservasi User
    Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservasi');
    Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservasi.store');
});


// --- ADMIN AREA ---
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // 1. Kelola Layanan (Services)
    Route::get('/services', [ServiceController::class, 'adminIndex'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // 2. Kelola Tentang Kami (About)
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');

    // 3. Kelola Reservasi
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::put('/reservations/{id}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    // 4. Kelola Pesan Masuk (Contacts)
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});