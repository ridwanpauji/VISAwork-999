<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index()
    {
        // Tempat mengambil data dari database nantinya
        return view('keuangan.index');
    }
}