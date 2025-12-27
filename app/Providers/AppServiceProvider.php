<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View; // Tambahan
use Illuminate\Support\Facades\Schema; // Tambahan
use App\Models\Setting; // Tambahan

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS di Production
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // BAGIAN PENTING: Share data setting ke semua view
        // Menggunakan Schema::hasTable untuk mencegah error saat pertama kali migrate
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            // Jika data belum ada (null), kita kirim null agar tidak error di view
            View::share('setting', $setting);
        }
    }
}