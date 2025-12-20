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
// 1. HALAMAN PUBLIK (BISA DIBUKA SIAPA SAJA)
// ====================================================
Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/barberman', [PublicController::class, 'barberman'])->name('barberman');
Route::get('/pricelist', [PublicController::class, 'pricelist'])->name('pricelist');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

// Kirim Pesan (Form Kontak)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// ====================================================
// 2. AUTHENTICATION (Login, Register, Logout)
// ====================================================

// Grup Guest: Hanya bisa diakses jika BELUM login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

// Logout (Bisa diakses user/admin yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================================================
// 3. HALAMAN USER (Wajib Login)
// ====================================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', function () {
        // PENGAMAN: Jika emailnya admin, paksa pindah ke dashboard admin
        // Supaya Admin tidak melihat tampilan user biasa
        if (Auth::user()->email === 'admin@jarsan.com') {
            return redirect()->route('admin.dashboard');
        }
        return view('user.dashboard');
    })->name('dashboard');

    // Reservasi oleh User
    Route::get('/reservasi', [ReservationController::class, 'create'])->name('reservasi');
    Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservasi.store');
});


// ====================================================
// 4. HALAMAN ADMIN (Panel Admin Lengkap)
// ====================================================
// Wajib Login ('auth') DAN Wajib Admin ('is_admin')
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // A. Dashboard Utama Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // B. Manajemen Layanan (Pricelist)
    Route::get('/services', [ServiceController::class, 'adminIndex'])->name('services');       
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');     
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update'); 
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy'); 

    // C. Manajemen Barberman (Tim)
    Route::get('/barbers', [BarberController::class, 'index'])->name('barbers.index');         
    Route::post('/barbers', [BarberController::class, 'store'])->name('barbers.store');        
    Route::put('/barbers/{id}', [BarberController::class, 'update'])->name('barbers.update');  
    Route::delete('/barbers/{id}', [BarberController::class, 'destroy'])->name('barbers.destroy'); 
    
    // D. Manajemen Tentang Kami (About)
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/update', [AboutController::class, 'update'])->name('about.update');

    // E. Manajemen Reservasi (Acc/Hapus/Status)
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations');
    Route::put('/reservations/{id}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    
    // F. Manajemen Pesan Masuk (Contacts)
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});