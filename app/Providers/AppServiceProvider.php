<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // 1. Tambahkan baris ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paksa HTTPS saat diakses via Ngrok, Reverse Proxy, atau Environment non-local
        if (request()->hasHeader('x-forwarded-proto') || str_contains(request()->getHost(), 'ngrok') || config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
    }
}