<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/barberman', function () {
    return view('barberman');
})->name('barberman');

Route::get('/pricelist', function () {
    return view('pricelist');
})->name('pricelist');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/reservasi', function () {
    return view('reservasi');
});


// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Logout (opsional)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Proses register
Route::post('/register', [AuthController::class, 'register'])->name('register.process');