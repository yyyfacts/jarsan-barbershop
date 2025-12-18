<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN (Wajib pakai email ini biar jadi admin)
        User::create([
            'name' => 'Admin Jarsan',
            'email' => 'admin@jarsan.com', // JANGAN DIGANTI (Ini kuncinya)
            'password' => Hash::make('password123'), // Passwordnya ini
            'email_verified_at' => now(),
        ]);

        // 2. BUAT AKUN USER BIASA (Buat ngetes tampilan user)
        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}