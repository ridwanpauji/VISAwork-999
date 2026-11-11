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
                        slatebg: '#F8FAFC',
                        surface: '#FFFFFF',
                        borderSubtle: '#E2E8F0',
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-700 transition-colors duration-300 flex flex-col min-h-screen overflow-x-hidden antialiased">

    <!-- 1. NAVBAR -->
    <nav class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 py-3.5 sticky top-0 z-50">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 flex items-center justify-between">
            
            <!-- Logo VISAwork -->
            <a href="#" class="flex items-center gap-2 text-xl font-semibold tracking-tight text-slate-900 shrink-0">
                <img src="{{ asset('img/visaworklogo.png') }}" alt="Logo VISAwork" class="h-8 w-auto">
                <span>VISA<span class="text-emerald-600 font-normal">work</span></span>
            </a>
            
            <!-- Menu Navigasi -->
            <div class="hidden lg:flex items-center space-x-9 text-sm font-medium text-slate-600">
                <a href="#fitur" data-i18n="nav-fitur" class="hover:text-emerald-600 transition-colors py-1">Fitur</a>
                <a href="#keunggulan" data-i18n="nav-keunggulan" class="hover:text-emerald-600 transition-colors py-1">Keunggulan</a>
                <a href="#tentang" data-i18n="nav-tentang" class="hover:text-emerald-600 transition-colors py-1">Tentang Kami</a>
            </div>

            <!-- Autentikasi & Bahasa -->
            <div class="flex items-center space-x-2 md:space-x-4 shrink-0">
                
                <!-- PILIHAN BAHASA -->
                <div class="relative group cursor-pointer">
                    <button class="flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium text-slate-600 hover:text-emerald-700 rounded-lg bg-slate-100 hover:bg-slate-200/70 transition border border-slate-200/60">
                        <span id="current-lang">ID</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-emerald-600 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Bahasa -->
                    <div class="absolute right-0 mt-2 w-36 bg-white border border-slate-200 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                        <div class="py-1">
                            <button onclick="changeLanguage('id')" class="w-full text-left flex items-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                <span>🇮🇩</span> Indonesia
                            </button>
                            <button onclick="changeLanguage('en')" class="w-full text-left flex items-center gap-2 px-4 py-2 text-xs font-medium text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition">
                                <span>🇺🇸</span> English (US)
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pemisah vertikal -->
                <div class="hidden sm:block w-px h-5 bg-slate-200"></div>

                <!-- Tombol Login & Register -->
                <a href="/login" data-i18n="nav-login" class="px-3.5 py-2 text-sm font-medium text-slate-600 hover:text-emerald-700 transition hidden sm:block">
                    Masuk
                </a>
                <a href="/register" data-i18n="nav-register" class="px-5 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition shadow-sm">
                    Daftar Akun
                </a>
            </div>
        </div>
    </nav>

    <!-- 2. HERO SECTION -->
    <section class="relative max-w-[1440px] mx-auto px-6 md:px-12 min-h-[calc(100vh-140px)] flex items-center pt-10 pb-20 w-full">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center w-full z-10">
            
            <!-- Kolom Kiri: Teks & Nilai Utama -->
            <div class="lg:col-span-6 text-left">
                <div class="mb-5">
                    <span data-i18n="hero-badge" class="inline-flex items-center gap-2 px-3.5 py-1.5 text-xs font-medium text-emerald-800 bg-emerald-100/70 rounded-full border border-emerald-200/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        Platform Pembukuan Digital Modern
                    </span>
                </div>

                <h1 data-i18n="hero-title" class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-slate-900 tracking-tight mb-6 leading-[1.18]">
                    Kelola Keuangan<br class="hidden sm:block">
                    <span class="font-bold text-slate-800">Bisnis Tanpa Ribet</span>
                </h1>

                <p data-i18n="hero-desc" class="text-base md:text-lg text-slate-600 max-w-xl mb-8 leading-relaxed font-normal">
                    Pencatatan arus kas debit/kredit, pantau saldo aktif, hingga manajemen inventaris barang dalam satu antarmuka yang bersih, cepat, dan nyaman di mata.
                </p>

                <div class="flex flex-wrap items-center gap-3.5">
                    <a href="/register" data-i18n="btn-start" class="px-7 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                        Mulai Sekarang
                    </a>
                    
                    <a href="#fitur" class="group inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-300 text-slate-700 text-sm font-medium rounded-lg hover:border-slate-400 hover:bg-slate-50 transition shadow-sm">
                        <span data-i18n="btn-learn">Pelajari Fitur</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Mini Social Proof / Checklist -->
                <div class="mt-8 pt-6 border-t border-slate-200/70 flex flex-wrap gap-6 text-xs text-slate-500">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Gratis Akun Bisnis</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Ringkasan Otomatis</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Penyimpanan Aman</span>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Preview Gambar UI Asli -->
            <div class="lg:col-span-6 relative">
                <div class="rounded-xl border border-slate-200 shadow-md overflow-hidden bg-white">
                    <img src="{{ asset('img/dashboard-preview.png') }}" 
                         alt="Preview Dashboard VISAwork" 
                         class="w-full h-auto object-cover block">
                </div>
            </div>

        </div>
    </section>

    <!-- 3. FITUR UTAMA -->
    <section id="fitur" class="bg-white py-20 border-t border-slate-200/80">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 w-full">
            <div class="text-center mb-14">
                <h2 data-i18n="feat-title" class="text-3xl md:text-4xl font-semibold text-slate-900 mb-3 tracking-tight">Fitur Utama Platform</h2>
                <p data-i18n="feat-desc" class="text-slate-500 text-sm md:text-base font-normal max-w-2xl mx-auto leading-relaxed">Dibuat khusus untuk pengusaha, pemilik toko, dan tim operasional.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Fitur 1 -->
                <div class="bg-slate-50/70 rounded-2xl border border-slate-200 hover:border-slate-300 transition duration-300 overflow-hidden flex flex-col hover:shadow-sm">
                    <div class="p-8 md:p-10 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-5">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span data-i18n="feat1-badge" class="px-3 py-1 text-xs font-medium text-emerald-800 bg-emerald-100/80 rounded-md border border-emerald-200 mb-3 inline-block">Modul Finansial</span>
                            <h3 data-i18n="feat1-title" class="font-semibold text-slate-900 mb-3 text-xl">Pencatatan Arus Kas</h3>
                            <p data-i18n="feat1-desc" class="text-sm text-slate-600 leading-relaxed font-normal mb-6">Hitung saldo aktif otomatis, filter transaksi pemasukan & pengeluaran, serta catat kategori setiap mutasi keuangan bisnis.</p>
                        </div>
                        <ul class="text-xs text-slate-500 space-y-2 pt-4 border-t border-slate-200/60">
                            <li class="flex items-center gap-2">✓ Validasi kalkulasi debit & kredit instan</li>
                            <li class="flex items-center gap-2">✓ Pencarian data histori tanpa hambatan</li>
                        </ul>
                    </div>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-slate-50/70 rounded-2xl border border-slate-200 hover:border-slate-300 transition duration-300 overflow-hidden flex flex-col hover:shadow-sm">
                    <div class="p-8 md:p-10 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-5">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <span data-i18n="feat2-badge" class="px-3 py-1 text-xs font-medium text-slate-700 bg-slate-200 rounded-md border border-slate-300 mb-3 inline-block">Inventaris Produk</span>
                            <h3 data-i18n="feat2-title" class="font-semibold text-slate-900 mb-3 text-xl">Manajemen Stok & Valuasi</h3>
                            <p data-i18n="feat2-desc" class="text-sm text-slate-600 leading-relaxed font-normal mb-6">Kelola katalog barang, pantau sisa kuantitas barang, estimasi nilai aset fisik, serta peroleh peringatan saat stok mulai habis.</p>
                        </div>
                        <ul class="text-xs text-slate-500 space-y-2 pt-4 border-t border-slate-200/60">
                            <li class="flex items-center gap-2">✓ Peringatan otomatis produk stok menipis (&lt; 5)</li>
                            <li class="flex items-center gap-2">✓ Kalkulasi otomatis estimasi nilai persediaan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. KEUNGGULAN -->
    <section id="keunggulan" class="bg-slate-50 py-20 border-t border-slate-200/80">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 w-full">
            <div class="text-center mb-14">
                <h2 data-i18n="adv-title" class="text-3xl md:text-4xl font-semibold text-slate-900 mb-3 tracking-tight">Keunggulan Platform</h2>
                <p data-i18n="adv-desc" class="text-slate-500 text-sm md:text-base font-normal max-w-2xl mx-auto leading-relaxed">Dirancang dengan antarmuka yang bersih, cepat diakses, dan ramah pengguna.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <!-- Keunggulan 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 data-i18n="adv1-title" class="font-semibold text-slate-900 text-base mb-2">Performa Sangat Ringan</h3>
                    <p data-i18n="adv1-desc" class="text-xs text-slate-600 leading-relaxed font-normal">Antarmuka cepat terbuka tanpa lag berkat arsitektur Laravel Breeze dan Tailwind CSS.</p>
                </div>

                <!-- Keunggulan 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 data-i18n="adv2-title" class="font-semibold text-slate-900 text-base mb-2">Data Terisolasi Aman</h3>
                    <p data-i18n="adv2-desc" class="text-xs text-slate-600 leading-relaxed font-normal">Setiap pengguna hanya dapat melihat dan memodifikasi data keuangan miliknya sendiri.</p>
                </div>

                <!-- Keunggulan 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">
                    <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-base mb-2">Bilingual Siap Pakai</h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal">Mendukung peralihan instan Bahasa Indonesia & English US yang tersimpan otomatis di browser.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. TENTANG KAMI -->
    <section id="tentang" class="bg-white py-20 border-t border-slate-200/80">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 w-full">
            <div class="max-w-3xl mx-auto text-center">
                <h2 data-i18n="about-title" class="text-3xl font-semibold text-slate-900 mb-4 tracking-tight">Mengenai VISAwork</h2>
                <p data-i18n="about-desc" class="text-slate-600 leading-relaxed text-base font-normal mb-8">
                    VISAwork dikembangkan sebagai solusi perangkat lunak mandiri untuk penataan administrasi keuangan yang transparan, terstruktur, dan terukur. Kami percaya bahwa setiap bisnis membutuhkan fondasi pencatatan yang solid untuk bisa bertumbuh.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="/register" data-i18n="about-btn" class="inline-flex items-center px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-lg transition shadow-sm">
                        Buat Akun Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 py-8 text-center text-xs font-normal text-slate-400 border-t border-slate-800">
        VISAwork v1.4.0 &copy; 2026. Platform Manajemen Operasional & Keuangan. Hak Cipta Dilindungi.
    </footer>

    <!-- SCRIPT MULTI-BAHASA TERPUSAT -->
    <script src="{{ asset('js/translations.js') }}"></script>
</body>
</html>
