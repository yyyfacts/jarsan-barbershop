<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil UserSeeder disini
        $this->call([
            UserSeeder::class,
        ]);
    }
}