<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- 1. Tambahkan baris ini

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 2. Paksa semua asset (gambar, css, js) menggunakan HTTPS
        if (config('app.env') !== 'local' || request()->hasHeader('x-forwarded-proto')) {
            URL::forceScheme('https');
        }
    }
}