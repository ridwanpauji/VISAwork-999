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
                        lightbg: '#F8F9FA', 
                        brand: {
                            DEFAULT: '#059669',
                            hover: '#047857',
                        }
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
<body class="bg-lightbg text-gray-700 transition-colors duration-300 flex flex-col min-h-screen overflow-x-hidden">

    <!-- 1. NAVBAR -->
    <nav class="bg-white/90 backdrop-blur-md border-b border-gray-200 py-4 sticky top-0 z-50">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 flex items-center justify-between">
            
            <!-- Logo VISAwork -->
            <a href="#" class="flex items-center gap-2 text-xl font-semibold tracking-tight text-gray-900 shrink-0">
                <img src="{{ asset('img/visaworklogo.png') }}" alt="Logo VISAwork" class="h-8 w-auto">
                <span>VISA<span class="text-emerald-600 font-normal">work</span></span>
            </a>
            
            <!-- Menu Navigasi -->
            <div class="hidden lg:flex items-center space-x-10 text-sm font-medium text-gray-600">
                <a href="#fitur" data-i18n="nav-fitur" class="hover:text-emerald-600 transition-colors py-1">Fitur</a>
                <a href="#solusi" data-i18n="nav-solusi" class="hover:text-emerald-600 transition-colors py-1">Solusi</a>
                <a href="#harga" data-i18n="nav-harga" class="hover:text-emerald-600 transition-colors py-1">Harga</a>
                <a href="#panduan" data-i18n="nav-panduan" class="hover:text-emerald-600 transition-colors py-1">Panduan</a>
                <a href="#tentang" data-i18n="nav-perusahaan" class="hover:text-emerald-600 transition-colors py-1">Perusahaan</a>
            </div>

            <!-- Autentikasi & Bahasa -->
            <div class="flex items-center space-x-2 md:space-x-4 shrink-0">
                
                <!-- PILIHAN BAHASA -->
                <div class="relative group cursor-pointer">
                    <button class="flex items-center gap-1 px-2 py-2 text-sm font-medium text-gray-600 hover:text-emerald-600 transition">
                        <span id="current-lang">ID</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Dropdown Bahasa -->
                    <div class="absolute right-0 mt-2 w-36 bg-white border border-gray-100 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 overflow-hidden">
                        <div class="py-1">
                            <button onclick="changeLanguage('id')" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-emerald-600 transition">
                                <span>🇮🇩</span> Indonesia
                            </button>
                            <button onclick="changeLanguage('en')" class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-emerald-600 transition">
                                <span>🇺🇸</span> English (US)
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tombol Pemisah vertikal -->
                <div class="hidden md:block w-px h-5 bg-gray-300"></div>

                <!-- Tombol Login & Register -->
                <a href="/login" data-i18n="nav-login" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-emerald-600 transition hidden sm:block">
                    Masuk
                </a>
                <a href="/register" data-i18n="nav-register" class="px-5 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-md transition shadow-sm">
                    Daftar Akun
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative max-w-[1440px] mx-auto px-6 md:px-12 min-h-[calc(100vh-140px)] flex items-center pt-12 pb-20 w-full">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center w-full z-10">
            
            <!-- Kolom Kiri: Teks -->
            <div class="lg:col-span-6 text-left">
                <div class="mb-6">
                    <span data-i18n="hero-badge" class="inline-block px-3.5 py-1.5 text-xs font-medium text-emerald-800 bg-emerald-100 rounded-full border border-emerald-200">
                        Tahap Pengembangan v1.0.0
                    </span>
                </div>

                <h1 data-i18n="hero-title" class="text-4xl sm:text-5xl lg:text-6xl font-semibold text-gray-900 tracking-tight mb-6 leading-[1.2]">
                    Kelola Keuangan<br class="hidden sm:block">
                    <span class="font-bold text-gray-800">Dengan VISAwork</span>
                </h1>

                <p data-i18n="hero-desc" class="text-base md:text-lg text-gray-600 max-w-xl mb-8 leading-relaxed font-normal">
                    Ringkasan finansial, arus kas, hingga pencatatan stok barang dalam tampilan bersih, cepat, dan teratur tanpa kerumitan.
                </p>

                <div class="flex items-center gap-4">
                    <a href="/register" data-i18n="btn-start" class="px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                        Mulai Sekarang
                    </a>
                    
                    <a href="#fitur" class="group inline-flex items-center gap-2 px-7 py-3.5 bg-white border border-gray-200 text-gray-700 text-sm font-medium rounded-lg hover:border-gray-300 hover:bg-gray-50 transition shadow-sm">
                        <span data-i18n="btn-learn">Pelajari Fitur</span>
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Kolom Kanan: Preview Gambar -->
            <div class="lg:col-span-6 relative">
                <div class="rounded-2xl border border-gray-200 overflow-hidden transition-all duration-300 bg-white">
                    <img src="{{ asset('img/porsche.jpg') }}" 
                         alt="Preview VISAwork" 
                         class="w-full h-auto object-cover block"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <div class="bg-gray-100 py-40 px-8 text-center text-gray-400 font-normal text-sm hidden">
                        [ Preview Interface ]
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. FITUR UTAMA -->
    <section id="fitur" class="bg-white py-24 border-t border-gray-200">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 w-full">
            <div class="text-center mb-16">
                <h2 data-i18n="feat-title" class="text-3xl md:text-4xl font-semibold text-gray-900 mb-4">Fitur Utama Platform</h2>
                <p data-i18n="feat-desc" class="text-gray-500 text-base font-normal max-w-2xl mx-auto leading-relaxed">Dirancang untuk mempermudah pencatatan dan operasional harian Anda.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Fitur 1 -->
                <div class="bg-gray-50 rounded-2xl border border-gray-200 hover:border-gray-300 transition duration-300 overflow-hidden flex flex-col hover:shadow-md">
                    <div class="h-64 bg-gray-200 relative overflow-hidden border-b border-gray-200">
                        <img src="{{ asset('img/foto-fitur-1.jpg') }}" alt="Pencatatan Finansial" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="absolute inset-0 bg-gray-100 flex items-center justify-center text-gray-400 text-sm hidden">
                            [ Tempat Foto Fitur 1 ]
                        </div>
                    </div>
                    <div class="p-8 md:p-10 flex-1 flex flex-col justify-between">
                        <div>
                            <span data-i18n="feat1-badge" class="px-3 py-1 text-xs font-medium text-emerald-700 bg-emerald-100 rounded border border-emerald-200 mb-4 inline-block">Modul Utama</span>
                            <h3 data-i18n="feat1-title" class="font-medium text-gray-900 mb-4 text-xl">Pencatatan & Arus Kas</h3>
                            <p data-i18n="feat1-desc" class="text-base text-gray-600 leading-relaxed font-normal mb-8">Pengelolaan saldo otomatis, pelacakan histori transaksi debit/kredit, serta pembuatan rekapitulasi harian secara terstruktur.</p>
                        </div>
                    </div>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-gray-50 rounded-2xl border border-gray-200 hover:border-gray-300 transition duration-300 overflow-hidden flex flex-col hover:shadow-md">
                    <div class="h-64 bg-gray-200 relative overflow-hidden border-b border-gray-200">
                        <img src="{{ asset('img/foto-fitur-2.jpg') }}" alt="Manajemen Produk" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="absolute inset-0 bg-gray-100 flex items-center justify-center text-gray-400 text-sm hidden">
                            [ Tempat Foto Fitur 2 ]
                        </div>
                    </div>
                    <div class="p-8 md:p-10 flex-1 flex flex-col justify-between">
                        <div>
                            <span data-i18n="feat2-badge" class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-200 rounded border border-gray-300 mb-4 inline-block">Inventaris</span>
                            <h3 data-i18n="feat2-title" class="font-medium text-gray-900 mb-4 text-xl">Manajemen Produk</h3>
                            <p data-i18n="feat2-desc" class="text-base text-gray-600 leading-relaxed font-normal mb-8">Pengontrolan stok barang masuk dan keluar, penyesuaian harga jual, serta pemantauan stok terkini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. KEUNGGULAN -->
    <section id="keunggulan" class="bg-lightbg py-24 border-t border-gray-200">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 w-full">
            <div class="text-center mb-16">
                <h2 data-i18n="adv-title" class="text-3xl md:text-4xl font-semibold text-gray-900 mb-4">Keunggulan Platform</h2>
                <p data-i18n="adv-desc" class="text-gray-500 text-base font-normal max-w-2xl mx-auto leading-relaxed">Dirancang dengan efisiensi tinggi tanpa beban komputasi berlebih.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <!-- Keunggulan 1 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex items-center">
                    <div class="w-1/3 h-full bg-gray-100 min-h-[160px] relative border-r border-gray-200">
                        <img src="{{ asset('img/foto-unggul-1.jpg') }}" class="w-full h-full object-cover absolute inset-0" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs text-center p-2 hidden">
                            [ Foto<br>Responsif ]
                        </div>
                    </div>
                    <div class="p-6 w-2/3">
                        <h3 data-i18n="adv1-title" class="font-medium text-gray-900 text-lg mb-2">Performa Responsif</h3>
                        <p data-i18n="adv1-desc" class="text-sm text-gray-600 leading-relaxed font-normal">Ringan dimuat bahkan pada koneksi terbatas berkat arsitektur teroptimasi.</p>
                    </div>
                </div>

                <!-- Keunggulan 2 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex items-center">
                    <div class="w-1/3 h-full bg-gray-100 min-h-[160px] relative border-r border-gray-200">
                        <img src="{{ asset('img/foto-unggul-2.jpg') }}" class="w-full h-full object-cover absolute inset-0" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs text-center p-2 hidden">
                            [ Foto<br>Keamanan ]
                        </div>
                    </div>
                    <div class="p-6 w-2/3">
                        <h3 data-i18n="adv2-title" class="font-medium text-gray-900 text-lg mb-2">Akses Terkontrol</h3>
                        <p data-i18n="adv2-desc" class="text-sm text-gray-600 leading-relaxed font-normal">Manajemen isolasi data berbasis sesi dan perlindungan autentikasi yang aman.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. TENTANG KAMI -->
    <section id="tentang" class="bg-white py-24 border-t border-gray-200">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Kolom Kiri: Foto Perusahaan -->
                <div class="relative">
                    <div class="rounded-2xl overflow-hidden aspect-video lg:aspect-square bg-gray-100 border border-gray-200 shadow-sm relative">
                        <img src="{{ asset('img/foto-tentang-kami.jpg') }}" alt="Tentang VISAwork" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="absolute inset-0 bg-gray-50 flex items-center justify-center text-gray-400 text-sm hidden">
                            [ Tempat Foto Tim / Perusahaan ]
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Teks -->
                <div class="text-left">
                    <h2 data-i18n="about-title" class="text-3xl md:text-4xl font-semibold text-gray-900 mb-6">Mengenai Perusahaan</h2>
                    <p data-i18n="about-desc" class="text-gray-600 leading-relaxed text-base md:text-lg font-normal mb-8">
                        VISAwork dikembangkan sebagai solusi perangkat lunak mandiri untuk penataan administrasi keuangan yang transparan, terstruktur, dan terukur. Kami percaya bahwa setiap bisnis membutuhkan fondasi pencatatan yang solid untuk bisa bertumbuh.
                    </p>
                    <ul class="space-y-4 mb-10 text-gray-600">
                        <li class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 text-sm font-bold">✓</span> 
                            <span data-i18n="about-list1">Misi mempermudah pembukuan</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 text-sm font-bold">✓</span> 
                            <span data-i18n="about-list2">Dukungan teknis berkelanjutan</span>
                        </li>
                    </ul>
                    <a href="/register" data-i18n="about-btn" class="inline-block px-8 py-3.5 bg-gray-900 hover:bg-gray-800 text-white text-base font-medium rounded-lg transition shadow-md">
                        Kenali Kami Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer data-i18n="footer-text" class="bg-gray-900 py-10 text-center text-sm font-normal text-gray-400">
        VISAwork v1.0.0 &copy; 2026. Hak Cipta Dilindungi.
    </footer>

    <!-- SCRIPT MULTI-BAHASA -->
    <script>
        const translations = {
            id: {
                "nav-fitur": "Fitur",
                "nav-solusi": "Solusi",
                "nav-harga": "Harga",
                "nav-panduan": "Panduan",
                "nav-perusahaan": "Perusahaan",
                "nav-login": "Masuk",
                "nav-register": "Daftar Akun",
                
                "hero-badge": "Tahap Pengembangan v1.0.0",
                "hero-title": "Kelola Keuangan<br class='hidden sm:block'><span class='font-bold text-gray-800'>Dengan VISAwork</span>",
                "hero-desc": "Ringkasan finansial, arus kas, hingga pencatatan stok barang dalam tampilan bersih, cepat, dan teratur tanpa kerumitan.",
                "btn-start": "Mulai Sekarang",
                "btn-learn": "Pelajari Fitur",

                "feat-title": "Fitur Utama Platform",
                "feat-desc": "Dirancang untuk mempermudah pencatatan dan operasional harian Anda.",
                "feat1-badge": "Modul Utama",
                "feat1-title": "Pencatatan & Arus Kas",
                "feat1-desc": "Pengelolaan saldo otomatis, pelacakan histori transaksi debit/kredit, serta pembuatan rekapitulasi harian secara terstruktur.",
                "feat2-badge": "Inventaris",
                "feat2-title": "Manajemen Produk",
                "feat2-desc": "Pengontrolan stok barang masuk dan keluar, penyesuaian harga jual, serta pemantauan stok terkini.",

                "adv-title": "Keunggulan Platform",
                "adv-desc": "Dirancang dengan efisiensi tinggi tanpa beban komputasi berlebih.",
                "adv1-title": "Performa Responsif",
                "adv1-desc": "Ringan dimuat bahkan pada koneksi terbatas berkat arsitektur teroptimasi.",
                "adv2-title": "Akses Terkontrol",
                "adv2-desc": "Manajemen isolasi data berbasis sesi dan perlindungan autentikasi yang aman.",

                "about-title": "Mengenai Perusahaan",
                "about-desc": "VISAwork dikembangkan sebagai solusi perangkat lunak mandiri untuk penataan administrasi keuangan yang transparan, terstruktur, dan terukur. Kami percaya bahwa setiap bisnis membutuhkan fondasi pencatatan yang solid untuk bisa bertumbuh.",
                "about-list1": "Misi mempermudah pembukuan",
                "about-list2": "Dukungan teknis berkelanjutan",
                "about-btn": "Kenali Kami Lebih Lanjut",

                "footer-text": "VISAwork v1.0.0 &copy; 2026. Hak Cipta Dilindungi."
            },
            en: {
                "nav-fitur": "Features",
                "nav-solusi": "Solutions",
                "nav-harga": "Pricing",
                "nav-panduan": "Guides",
                "nav-perusahaan": "Company",
                "nav-login": "Sign In",
                "nav-register": "Create Account",
                
                "hero-badge": "Development Phase v1.0.0",
                "hero-title": "Manage Finances<br class='hidden sm:block'><span class='font-bold text-gray-800'>With VISAwork</span>",
                "hero-desc": "Financial summaries, cash flows, and inventory tracking in a clean, fast, and organized interface without the hassle.",
                "btn-start": "Get Started",
                "btn-learn": "Learn Features",

                "feat-title": "Core Platform Features",
                "feat-desc": "Designed to simplify your daily recording and operations.",
                "feat1-badge": "Main Module",
                "feat1-title": "Accounting & Cash Flow",
                "feat1-desc": "Automated balance management, debit/credit transaction tracking, and structured daily reporting.",
                "feat2-badge": "Inventory",
                "feat2-title": "Product Management",
                "feat2-desc": "Control inbound and outbound stock, adjust selling prices, and monitor real-time inventory.",

                "adv-title": "Platform Advantages",
                "adv-desc": "Designed for high efficiency without excessive computational load.",
                "adv1-title": "Responsive Performance",
                "adv1-desc": "Loads lightweight even on limited connections thanks to an optimized architecture.",
                "adv2-title": "Controlled Access",
                "adv2-desc": "Session-based data isolation management and secure authentication protection.",

                "about-title": "About The Company",
                "about-desc": "VISAwork was developed as an independent software solution for transparent, structured, and measurable financial administration. We believe every business needs a solid recording foundation to grow.",
                "about-list1": "Mission to simplify bookkeeping",
                "about-list2": "Continuous technical support",
                "about-btn": "Get to Know Us Better",

                "footer-text": "VISAwork v1.0.0 &copy; 2026. All Rights Reserved."
            }
        };

        function changeLanguage(lang) {
            // Update tulisan di UI
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if(translations[lang][key]) {
                    element.innerHTML = translations[lang][key];
                }
            });

            // Update label bahasa di Navbar
            document.getElementById('current-lang').innerText = lang.toUpperCase();
            
            // Ubah atribut lang di tag html
            document.documentElement.lang = lang;
        }
    </script>
</body>
</html>