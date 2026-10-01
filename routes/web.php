<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController; // Ini wajib ditambahkan agar controller terbaca

Route::get('/', function () {
    return view('welcome');
});

// Rute halaman VISAwork sekarang diarahkan ke Controller
Route::get('/keuangan', [KeuanganController::class, 'index']);