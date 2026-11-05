<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- 1. Pastikan baris ini ada

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 2. Paksa semua URL asset & route menjadi HTTPS saat diakses via Ngrok/Proxy
        if (request()->hasHeader('x-forwarded-proto') || config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}