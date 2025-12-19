<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;      // Controller Halaman Depan
use App\Http\Controllers\ReservationController; // Controller Reservasi
use App\Http\Controllers\ServiceController;     // Controller Layanan/Pricelist
use App\Http\Controllers\AdminController;       // Controller Dashboard Admin
use App\Http\Controllers\ContactController;     // Controller Pesan Masuk
use App\Http\Controllers\AboutController;       // Controller Tentang Kami
use App\Http\Controllers\BarberController;      // Controller Barberman

// ====================================================
// 1. HALAMAN PUBLIK (BISA DIBUKA SIAPA SAJA)
// ====================================================

// Menggunakan 'PublicController' agar data dikirim ke view dengan benar
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

// Route untuk Tamu (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

// Route Logout (Bisa diakses jika sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ====================================================
// 3. HALAMAN USER (Wajib Login)
// ====================================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard User
    Route::get('/dashboard', function () {
        // Logika: Jika emailnya admin, paksa pindah ke dashboard admin
        if(auth()->user()->email == 'admin@jarsan.com') {
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
// Middleware 'is_admin' harus sudah dibuat dan didaftarkan di Kernel/Bootstrap
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // A. Dashboard Utama Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // B. Manajemen Layanan (Pricelist)
    Route::get('/services', [ServiceController::class, 'adminIndex'])->name('services');       // Lihat Daftar
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');     // Simpan Baru
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update'); // Update
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy'); // Hapus
    // Note: Route create/edit dihapus karena sudah pakai MODAL di index

    // C. Manajemen Barberman (Tim)
    Route::get('/barbers', [BarberController::class, 'index'])->name('barbers.index');         // Lihat Daftar
    Route::post('/barbers', [BarberController::class, 'store'])->name('barbers.store');        // Simpan Baru
    Route::put('/barbers/{id}', [BarberController::class, 'update'])->name('barbers.update');  // Update
    Route::delete('/barbers/{id}', [BarberController::class, 'destroy'])->name('barbers.destroy'); // Hapus
    // Note: Route create/edit dihapus karena sudah pakai MODAL di index
    
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
    
    // G. Route Darurat (Opsional: Hanya pakai jika perlu buat user manual di Vercel)
    // Hapus baris di bawah ini jika sudah tidak dipakai
    /*
    Route::get('/paksa-bikin-user', function () {
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            ['name' => 'Pelanggan Darurat', 'password' => bcrypt('password123')]
        );
        return "User berhasil dibuat/ditemukan: " . $user->email;
    });
    */
});