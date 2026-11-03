<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center font-inter max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8">
            <h2 data-i18n="dash-title" class="font-semibold text-xl text-gray-800 leading-tight">
                Ikhtisar Keuangan
            </h2>
            <div class="text-sm text-gray-500 font-medium">
                <span data-i18n="dash-welcome">Selamat datang,</span> <span class="text-emerald-600 font-semibold">{{ Auth::user()->name }}</span>!
            </div>
        </div>
    </x-slot>

    <div class="py-8 font-inter bg-[#F8F9FA] min-h-[calc(100vh-140px)]">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- 1. BARIS KARTU RINGKASAN -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kartu Saldo Utama -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <div data-i18n="card1-title" class="text-sm font-medium text-gray-500 mb-2">Total Saldo Aktif</div>
                    <div class="text-3xl font-bold text-gray-900 mb-4">Rp 24.500.000</div>
                    <div class="flex items-center text-xs font-medium text-emerald-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        <span data-i18n="card1-sub">+12.5% dari bulan lalu</span>
                    </div>
                </div>

                <!-- Kartu Pemasukan -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div data-i18n="card2-title" class="text-sm font-medium text-gray-500 mb-2">Pemasukan Bulan Ini</div>
                    <div class="text-2xl font-bold text-gray-900 mb-4">Rp 8.200.000</div>
                    <div data-i18n="card2-sub" class="text-xs text-gray-400">Terakhir diperbarui 2 jam yang lalu</div>
                </div>

                <!-- Kartu Pengeluaran -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div data-i18n="card3-title" class="text-sm font-medium text-gray-500 mb-2">Pengeluaran Bulan Ini</div>
                    <div class="text-2xl font-bold text-gray-900 mb-4">Rp 3.150.000</div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mt-2">
                        <div class="bg-orange-400 h-1.5 rounded-full" style="width: 45%"></div>
                    </div>
                    <div data-i18n="card3-sub" class="text-xs text-gray-400 mt-2">45% dari batas anggaran</div>
                </div>
            </div>

            <!-- 2. BARIS KONTEN UTAMA (GRAFIK & AKSI) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Kiri: Placeholder Grafik -->
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 data-i18n="chart-title" class="font-semibold text-gray-800">Statistik Arus Kas</h3>
                        <select class="text-sm border-gray-200 text-gray-500 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 cursor-pointer">
                            <option data-i18n="chart-opt1">7 Hari Terakhir</option>
                            <option data-i18n="chart-opt2">Bulan Ini</option>
                            <option data-i18n="chart-opt3">Tahun Ini</option>
                        </select>
                    </div>
                    <div class="w-full h-64 bg-gray-50 rounded-xl border border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-10 h-10 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <span data-i18n="chart-empty-title" class="text-sm font-medium">Area Visualisasi Grafik</span>
                        <span data-i18n="chart-empty-sub" class="text-xs mt-1">Data akan tampil di sini</span>
                    </div>
                </div>

                <!-- Kanan: Tombol Aksi & Riwayat -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h3 data-i18n="action-title" class="font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="showDevAlert('Pemasukan')" class="flex flex-col items-center justify-center p-3 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition border border-emerald-100">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span data-i18n="act-in" class="text-xs font-medium">Pemasukan</span>
                            </button>
                            <button onclick="showDevAlert('Pengeluaran')" class="flex flex-col items-center justify-center p-3 rounded-xl bg-orange-50 text-orange-700 hover:bg-orange-100 transition border border-orange-100">
                                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                <span data-i18n="act-out" class="text-xs font-medium">Pengeluaran</span>
                            </button>
                            <button onclick="showDevAlert('Invoice')" class="col-span-2 flex items-center justify-center p-3 rounded-xl bg-gray-50 text-gray-700 hover:bg-gray-100 transition border border-gray-200 gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <span data-i18n="act-inv" class="text-sm font-medium">Buat Tagihan (Invoice)</span>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 data-i18n="trx-title" class="font-semibold text-gray-800">Transaksi Terakhir</h3>
                            <button data-i18n="trx-all" onclick="showDevAlert('Riwayat Transaksi')" class="text-xs font-medium text-emerald-600 hover:text-emerald-700">Lihat Semua</button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                    </div>
                                    <div>
                                        <div data-i18n="trx-1-title" class="text-sm font-medium text-gray-800">Pembayaran Klien A</div>
                                        <div data-i18n="trx-1-time" class="text-xs text-gray-400">Hari ini, 10:24</div>
                                    </div>
                                </div>
                                <div class="text-sm font-semibold text-emerald-600">+ Rp 2.500.000</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                    </div>
                                    <div>
                                        <div data-i18n="trx-2-title" class="text-sm font-medium text-gray-800">Tagihan Internet</div>
                                        <div data-i18n="trx-2-time" class="text-xs text-gray-400">Kemarin, 15:30</div>
                                    </div>
                                </div>
                                <div class="text-sm font-semibold text-gray-800">- Rp 450.000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ELEMEN TOAST NOTIFIKASI -->
    <div id="dev-toast" class="fixed bottom-5 right-5 transform translate-y-24 opacity-0 transition-all duration-300 z-50 flex items-center w-full max-w-xs p-4 space-x-3 text-gray-600 bg-white rounded-xl shadow-lg border border-gray-100" role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-10 h-10 text-orange-500 bg-orange-100 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <div data-i18n="toast-dev" class="text-sm font-semibold text-gray-800">Tahap Pengembangan</div>
            <div class="text-xs text-gray-500 mt-0.5">
                <span data-i18n="toast-desc1">Fitur</span> 
                <span id="toast-feature-name" class="font-medium text-gray-700"></span> 
                <span data-i18n="toast-desc2">belum tersedia pada versi Alpha ini.</span>
            </div>
        </div>
    </div>

    <!-- SCRIPT MULTI-BAHASA & TOAST -->
    <script>
        const translations = {
            id: {
                "nav-dashboard": "Dasbor",
                "nav-profile": "Profil",
                "nav-logout": "Keluar",
                "dash-title": "Ikhtisar Keuangan",
                "dash-welcome": "Selamat datang,",
                "card1-title": "Total Saldo Aktif",
                "card1-sub": "+12.5% dari bulan lalu",
                "card2-title": "Pemasukan Bulan Ini",
                "card2-sub": "Terakhir diperbarui 2 jam yang lalu",
                "card3-title": "Pengeluaran Bulan Ini",
                "card3-sub": "45% dari batas anggaran",
                "chart-title": "Statistik Arus Kas",
                "chart-opt1": "7 Hari Terakhir",
                "chart-opt2": "Bulan Ini",
                "chart-opt3": "Tahun Ini",
                "chart-empty-title": "Area Visualisasi Grafik",
                "chart-empty-sub": "Data akan tampil di sini",
                "action-title": "Aksi Cepat",
                "act-in": "Pemasukan",
                "act-out": "Pengeluaran",
                "act-inv": "Buat Tagihan (Invoice)",
                "trx-title": "Transaksi Terakhir",
                "trx-all": "Lihat Semua",
                "trx-1-title": "Pembayaran Klien A",
                "trx-1-time": "Hari ini, 10:24",
                "trx-2-title": "Tagihan Internet",
                "trx-2-time": "Kemarin, 15:30",
                "toast-dev": "Tahap Pengembangan",
                "toast-desc1": "Fitur",
                "toast-desc2": "belum tersedia pada tahap pengembangan ini."
            },
            en: {
                "nav-dashboard": "Dashboard",
                "nav-profile": "Profile",
                "nav-logout": "Log Out",
                "dash-title": "Financial Overview",
                "dash-welcome": "Welcome back,",
                "card1-title": "Total Active Balance",
                "card1-sub": "+12.5% from last month",
                "card2-title": "Income This Month",
                "card2-sub": "Last updated 2 hours ago",
                "card3-title": "Expenses This Month",
                "card3-sub": "45% of budget limit",
                "chart-title": "Cash Flow Statistics",
                "chart-opt1": "Last 7 Days",
                "chart-opt2": "This Month",
                "chart-opt3": "This Year",
                "chart-empty-title": "Chart Visualization Area",
                "chart-empty-sub": "Data will appear here",
                "action-title": "Quick Actions",
                "act-in": "Income",
                "act-out": "Expense",
                "act-inv": "Create Invoice",
                "trx-title": "Recent Transactions",
                "trx-all": "View All",
                "trx-1-title": "Client A Payment",
                "trx-1-time": "Today, 10:24 AM",
                "trx-2-title": "Internet Bill",
                "trx-2-time": "Yesterday, 03:30 PM",
                "toast-dev": "Development Phase",
                "toast-desc1": "The",
                "toast-desc2": "feature is not yet available in this phase."
            }
        };

        function changeLanguage(lang) {
            localStorage.setItem('visawork_lang', lang);
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if(translations[lang][key]) {
                    element.innerHTML = translations[lang][key];
                }
            });
            document.getElementById('current-lang').innerText = lang.toUpperCase();
            document.documentElement.lang = lang;
        }

        // Terapkan bahasa terakhir & Toast logic
        let toastTimeout;
        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('visawork_lang') || 'id';
            changeLanguage(savedLang);
        });

        function showDevAlert(featureName) {
            const toast = document.getElementById('dev-toast');
            document.getElementById('toast-feature-name').innerText = `"${featureName}"`;
            toast.classList.remove('translate-y-24', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            
            clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-24', 'opacity-0');
            }, 3000);
        }
    </script>
</x-app-layout>