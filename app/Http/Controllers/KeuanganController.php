<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Memanggil model Product yang baru saja dibuat

class KeuanganController extends Controller
{
    public function index()
    {
        // Mengambil seluruh data dari tabel products di database
        $products = Product::all();
        
        // Mengirim data tersebut ke halaman dashboard
        return view('keuangan.index', compact('products'));
    }
}