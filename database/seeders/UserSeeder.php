<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Pakai 'firstOrCreate' supaya tidak error kalau data sudah ada
        
        // 1. Akun ADMIN
        User::firstOrCreate(
            ['email' => 'admin@jarsan.com'], // Cek berdasarkan email
            [
                'name' => 'Owner Jarsan',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Akun USER BIASA
        User::firstOrCreate(
            ['email' => 'user@gmail.com'], // Cek berdasarkan email
            [
                'name' => 'Pelanggan Setia',
                'password' => Hash::make('password123'),
            ]
        );
    }
}