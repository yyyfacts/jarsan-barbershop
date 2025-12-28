<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Schema; 
use App\Models\Setting; 

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS di Production (Vercel/Hosting)
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // BAGIAN PENTING: Share data setting ke semua view secara otomatis
        if (Schema::hasTable('settings')) {
            $setting = Setting::first();
            View::share('setting', $setting);
        }
    }
}