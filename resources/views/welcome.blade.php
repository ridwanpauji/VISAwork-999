<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISAwork | Platform Manajemen Keuangan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        lightbg: '#F5FAF7',
                        brand: {
                            DEFAULT: '#059669',
                            hover: '#047857',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts: Inter (Font Standar Enterprise/Keuangan) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-lightbg text-gray-700 transition-colors duration-300 flex flex-col min-h-screen">

    <!-- 1. NAVBAR -->
    <nav class="bg-lightbg/80 backdrop-blur-md border-b border-emerald-900/5 py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 md:px-12 flex items-center justify-between">
            
            <!-- Logo VISAwork (Mepet Kiri Container) -->
            <a href="#" class="text-xl font-semibold tracking-tight text-gray-900 shrink-0">
                VISA<span class="text-emerald-600 font-normal">work</span>
            </a>
            
            <!-- Menu Navigasi (Tengah) -->
            <div class="hidden lg:flex items-center space-x-12 text-sm font-normal text-gray-600">
                <a href="#fitur" class="hover:text-emerald-600 transition-colors py-1">Fitur Utama</a>
                <a href="#keunggulan" class="hover:text-emerald-600 transition-colors py-1">Keunggulan</a>
                <a href="#tentang" class="hover:text-emerald-600 transition-colors py-1">Tentang Kami</a>
            </div>

            <!-- Autentikasi (Mepet Kanan Container) -->
            <div class="flex items-center space-x-4 shrink-0">
                <a href="/login" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-emerald-600 transition">
                    Masuk
                </a>
                <a href="/register" class="px-5 py-2 text-sm font-medium text-white bg-emerald-700 hover:bg-emerald-800 rounded-md transition shadow-xs">
                    Daftar Akun
                </a>
            </div>
        </div>
    </nav>

    <!-- 2. HERO SECTION (LEBIH KE ATAS & FONT INTER) -->
    <section class="max-w-7xl mx-auto px-6 md:px-12 min-h-[calc(100vh-140px)] flex items-center pt-8 pb-16 w-full">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center w-full">
            
            <!-- Kolom Kiri: Teks (Sejajar dengan Logo VISAwork di Navbar) -->
            <div class="lg:col-span-6 text-left">
    <!-- 1. Badge Status (Diberi Jarak & Muted Green) -->
    <div class="mb-6">
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 text-xs font-medium text-emerald-800 bg-emerald-500/10 border border-emerald-600/15 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
            Tahap Pengembangan v0.1.0
        </span>
    </div>

    <!-- 2. Judul Utama (Line Break Rapi & Seimbang) -->
    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-semibold text-gray-900 tracking-tight mb-6 leading-[1.2]">
        Kelola Keuangan<br class="hidden sm:block">
        <span class="font-bold text-gray-900">Dalam Satu Tempat</span>
    </h1>

    <!-- 3. Deskripsi Singkat (Ukuran Pas & Renggang) -->
    <p class="text-sm md:text-base text-gray-600 max-w-lg mb-8 leading-relaxed font-normal">
        Ringkasan finansial, arus kas, hingga pencatatan stok barang dalam tampilan bersih, cepat, dan teratur.
    </p>

    <!-- 4. Tombol Akses (Lebih Pas & Modern) -->
    <div class="flex items-center gap-4">
        <a href="/register" class="px-7 py-3 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-medium rounded-lg transition shadow-sm">
            Mulai Sekarang
        </a>
        
        <a href="#fitur" class="group inline-flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:border-emerald-600/30 hover:bg-emerald-50/50 transition">
            <span>Pelajari Fitur</span>
            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"></path>
            </svg>
        </a>
    </div>
</div>

            <!-- Kolom Kanan: Preview Gambar (PORSCHE / DASHBOARD) -->
            <div class="lg:col-span-6">
                <div class="p-2.5 bg-emerald-900/5 rounded-2xl border border-emerald-900/5 shadow-xs">
                    <img src="{{ asset('img/porsche.jpg') }}" 
                         alt="Preview VISAwork" 
                         class="w-full h-auto rounded-xl shadow-sm border border-emerald-900/5 object-cover"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">

                    <!-- Fallback jika gambar porsche belum dimasukkan -->
                    <div class="bg-white rounded-xl py-32 px-8 border border-emerald-900/5 text-center text-gray-400 font-normal text-sm hidden">
                        [ Preview Interface ]
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. FITUR UTAMA -->
    <section id="fitur" class="bg-emerald-50/30 py-28 border-t border-emerald-900/5 min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-6 md:px-12 w-full">
            <div class="text-center mb-16">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-3">Fitur Utama Platform</h2>
                <p class="text-gray-500 text-sm font-normal max-w-md mx-auto leading-relaxed">Dirancang untuk mempermudah pencatatan dan operasional harian Anda.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="md:col-span-2 p-8 bg-white/80 rounded-xl border border-emerald-900/5 hover:border-emerald-600/20 transition duration-300 backdrop-blur-xs flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-6">
                            <span class="px-3 py-1 text-xs font-normal text-emerald-800 bg-emerald-500/10 rounded border border-emerald-600/10">Modul Utama</span>
                            <span class="text-xs text-gray-400 font-normal">Real-time Sync</span>
                        </div>
                        <h3 class="font-medium text-gray-900 mb-3 text-lg">Pencatatan & Arus Kas Finansial</h3>
                        <p class="text-sm text-gray-600 leading-relaxed font-normal mb-8">Pengelolaan saldo otomatis, pelacakan histori transaksi debit/kredit, serta pembuatan rekapitulasi harian dan bulanan secara terstruktur.</p>
                    </div>
                    <div class="pt-4 border-t border-emerald-900/5 flex items-center gap-6 text-xs text-gray-500 font-normal">
                        <span>✓ Otomatisasi Jurnal</span>
                        <span>✓ Audit Trail</span>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="p-8 bg-white/80 rounded-xl border border-emerald-900/5 hover:border-emerald-600/20 transition duration-300 backdrop-blur-xs flex flex-col justify-between">
                    <div>
                        <span class="px-3 py-1 text-xs font-normal text-gray-600 bg-gray-200/50 rounded border border-gray-300/20 inline-block mb-6">Inventaris</span>
                        <h3 class="font-medium text-gray-900 mb-3 text-lg">Manajemen Produk</h3>
                        <p class="text-sm text-gray-600 leading-relaxed font-normal">Pengontrolan stok barang masuk dan keluar, penyesuaian harga jual, serta pemantauan stok terkini.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="md:col-span-3 p-8 bg-white/80 rounded-xl border border-emerald-900/5 hover:border-emerald-600/20 transition duration-300 backdrop-blur-xs flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="max-w-2xl">
                        <span class="px-3 py-1 text-xs font-normal text-gray-600 bg-gray-200/50 rounded border border-gray-300/20 inline-block mb-4">Visualisasi</span>
                        <h3 class="font-medium text-gray-900 mb-2 text-lg">Grafik & Laporan Analitis</h3>
                        <p class="text-sm text-gray-600 leading-relaxed font-normal">Ringkasan performa bisnis dalam bentuk grafik intuitif untuk membantu Anda mengambil keputusan secara cepat.</p>
                    </div>
                    <div class="shrink-0">
                        <a href="/register" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-xs font-normal rounded-md transition">
                            Lihat Demo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. KEUNGGULAN -->
    <section id="keunggulan" class="bg-lightbg py-28 border-t border-emerald-900/5 min-h-screen flex items-center">
        <div class="max-w-5xl mx-auto px-6 w-full">
            <div class="text-center mb-16">
                <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-3">Keunggulan Platform</h2>
                <p class="text-gray-500 text-sm font-normal max-w-md mx-auto leading-relaxed">Dirancang dengan efisiensi tinggi tanpa beban komputasi berlebih.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="p-8 bg-white/70 rounded-xl border border-emerald-900/5">
                    <h3 class="font-medium text-gray-900 text-base mb-3">⚡ Performa Responsif</h3>
                    <p class="text-sm text-gray-600 leading-relaxed font-normal">Ringan dimuat bahkan pada koneksi terbatas berkat arsitektur teroptimasi.</p>
                </div>
                <div class="p-8 bg-white/70 rounded-xl border border-emerald-900/5">
                    <h3 class="font-medium text-gray-900 text-base mb-3">🔒 Akses Terkontrol</h3>
                    <p class="text-sm text-gray-600 leading-relaxed font-normal">Manajemen isolasi data berbasis sesi dan perlindungan autentikasi yang aman.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. TENTANG KAMI -->
    <section id="tentang" class="bg-emerald-50/30 py-28 border-t border-emerald-900/5 min-h-screen flex items-center">
        <div class="max-w-3xl mx-auto px-6 text-center w-full">
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 mb-6">Mengenai VISAwork</h2>
            <p class="text-gray-600 leading-relaxed text-sm md:text-base font-normal mb-8 max-w-xl mx-auto">
                VISAwork dikembangkan sebagai solusi perangkat lunak mandiri untuk penataan administrasi keuangan yang transparan, terstruktur, dan terukur.
            </p>
            <div>
                <a href="/register" class="px-8 py-3.5 bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-medium rounded-md transition shadow-xs">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-lightbg border-t border-emerald-900/5 py-8 text-center text-xs font-normal text-gray-400">
        VISAwork v0.1.0 &copy; 2026. All rights reserved.
    </footer>

</body>
</html>