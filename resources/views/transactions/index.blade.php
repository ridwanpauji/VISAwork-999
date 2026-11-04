<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center font-inter max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 gap-4">
            <div>
                <h2 data-i18n="trx-page-title" class="font-semibold text-xl text-gray-800 leading-tight">
                    Pencatatan Arus Kas
                </h2>
                <p data-i18n="trx-page-sub" class="text-xs text-gray-500 mt-1">Kelola seluruh histori transaksi masuk dan keluar secara terstruktur.</p>
            </div>
            
            <!-- Tombol Tambah Transaksi -->
            <button onclick="openTrxModal()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span data-i18n="btn-add-trx">Tambah Transaksi</span>
            </button>
        </div>
    </x-slot>

    <div class="py-8 font-inter bg-[#F8F9FA] min-h-[calc(100vh-140px)]">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- KONTEN UTAMA: TABEL TRANSAKSI -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <!-- FILTER & SEARCH BAR -->
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    
                    <!-- Filter Tipe Transaksi -->
                    <div class="flex items-center bg-gray-100 p-1 rounded-xl w-full md:w-auto">
                        <button onclick="filterType('all')" id="btn-filter-all" data-i18n="filter-all" class="px-4 py-1.5 text-xs font-medium rounded-lg bg-white text-gray-800 shadow-sm transition w-1/3 md:w-auto">
                            Semua
                        </button>
                        <button onclick="filterType('income')" id="btn-filter-income" data-i18n="filter-income" class="px-4 py-1.5 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-800 transition w-1/3 md:w-auto">
                            Pemasukan
                        </button>
                        <button onclick="filterType('expense')" id="btn-filter-expense" data-i18n="filter-expense" class="px-4 py-1.5 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-800 transition w-1/3 md:w-auto">
                            Pengeluaran
                        </button>
                    </div>

                    <!-- Input Pencarian -->
                    <div class="relative w-full md:w-72">
                        <input type="text" placeholder="Cari transaksi..." class="w-full pl-9 pr-4 py-2 text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <!-- TABEL DATA -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                                <th data-i18n="th-date" class="py-3.5 px-6">Tanggal</th>
                                <th data-i18n="th-desc" class="py-3.5 px-6">Deskripsi / Keterangan</th>
                                <th data-i18n="th-cat" class="py-3.5 px-6">Kategori</th>
                                <th data-i18n="th-type" class="py-3.5 px-6">Tipe</th>
                                <th data-i18n="th-amount" class="py-3.5 px-6 text-right">Nominal</th>
                                <th data-i18n="th-action" class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            
                            <!-- Dummy Item 1 -->
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 text-gray-500 text-xs">04 Nov 2026</td>
                                <td class="py-4 px-6 font-medium text-gray-900">Pembayaran Project Landing Page</td>
                                <td class="py-4 px-6"><span class="px-2.5 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">Jasa Desain</span></td>
                                <td class="py-4 px-6">
                                    <span data-i18n="type-income" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Pemasukan
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right font-semibold text-emerald-600">+ Rp 3.500.000</td>
                                <td class="py-4 px-6 text-center">
                                    <button onclick="showDevAlert('Edit Transaksi')" class="text-gray-400 hover:text-emerald-600 p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                </td>
                            </tr>

                            <!-- Dummy Item 2 -->
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 text-gray-500 text-xs">03 Nov 2026</td>
                                <td class="py-4 px-6 font-medium text-gray-900">Langganan Fiber Optic Internet</td>
                                <td class="py-4 px-6"><span class="px-2.5 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">Operasional</span></td>
                                <td class="py-4 px-6">
                                    <span data-i18n="type-expense" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100">
                                        Pengeluaran
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right font-semibold text-gray-800">- Rp 450.000</td>
                                <td class="py-4 px-6 text-center">
                                    <button onclick="showDevAlert('Edit Transaksi')" class="text-gray-400 hover:text-emerald-600 p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- FOOTER TABEL / PAGINATION -->
                <div class="p-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                    <span data-i18n="pagination-info">Menampilkan 2 dari 2 transaksi</span>
                    <div class="flex gap-1">
                        <button data-i18n="btn-prev" class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 disabled:opacity-50" disabled>Sebelumnya</button>
                        <button data-i18n="btn-next" class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 disabled:opacity-50" disabled>Selanjutnya</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH TRANSAKSI -->
    <div id="trx-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-gray-100 relative font-inter">
            <div class="flex justify-between items-center mb-5">
                <h3 data-i18n="modal-title" class="text-lg font-semibold text-gray-900">Tambah Transaksi Baru</h3>
                <button onclick="closeTrxModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form onsubmit="event.preventDefault(); showDevAlert('Simpan Transaksi'); closeTrxModal();" class="space-y-4">
                <!-- Tipe -->
                <div>
                    <label data-i18n="lbl-trx-type" class="block text-xs font-medium text-gray-700 mb-1">Tipe Transaksi</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center justify-center p-2.5 border border-emerald-200 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-medium cursor-pointer">
                            <input type="radio" name="type" value="income" class="hidden" checked> <span data-i18n="type-income">Pemasukan</span>
                        </label>
                        <label class="flex items-center justify-center p-2.5 border border-gray-200 rounded-lg text-gray-600 text-xs font-medium cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="type" value="expense" class="hidden"> <span data-i18n="type-expense">Pengeluaran</span>
                        </label>
                    </div>
                </div>

                <!-- Nominal -->
                <div>
                    <label data-i18n="lbl-amount" class="block text-xs font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                    <input type="number" placeholder="Contoh: 500000" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label data-i18n="lbl-desc" class="block text-xs font-medium text-gray-700 mb-1">Keterangan / Deskripsi</label>
                    <input type="text" placeholder="Masukkan rincian transaksi" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label data-i18n="lbl-category" class="block text-xs font-medium text-gray-700 mb-1">Kategori</label>
                    <select class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Operasional</option>
                        <option>Penjualan / Jasa</option>
                        <option>Gaji / Honor</option>
                        <option>Lain-Lain</option>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-3 flex gap-3">
                    <button type="button" onclick="closeTrxModal()" data-i18n="btn-cancel" class="w-1/2 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50">Batal</button>
                    <button type="submit" data-i18n="btn-save" class="w-1/2 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium shadow-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ELEMEN TOAST NOTIFIKASI -->
    <div id="dev-toast" class="fixed bottom-5 right-5 transform translate-y-24 opacity-0 transition-all duration-300 z-50 flex items-center w-full max-w-xs p-4 space-x-3 text-gray-600 bg-white rounded-xl shadow-lg border border-gray-100" role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-10 h-10 text-orange-500 bg-orange-100 rounded-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        </div>
        <div>
            <div data-i18n="toast-dev" class="text-sm font-semibold text-gray-800">Tahap Pengembangan</div>
            <div class="text-xs text-gray-500 mt-0.5">Aksi <span id="toast-feature-name" class="font-medium text-gray-700"></span> simulasi UI.</div>
        </div>
    </div>

    <!-- SCRIPT MULTI-BAHASA & EVENT HANDLER -->
    <script>
        const translations = {
            id: {
                "nav-dashboard": "Dasbor",
                "nav-transactions": "Transaksi",
                "nav-inventory": "Inventaris",
                "nav-profile": "Profil",
                "nav-logout": "Keluar",
                "trx-page-title": "Pencatatan Arus Kas",
                "trx-page-sub": "Kelola seluruh histori transaksi masuk dan keluar secara terstruktur.",
                "btn-add-trx": "Tambah Transaksi",
                "filter-all": "Semua",
                "filter-income": "Pemasukan",
                "filter-expense": "Pengeluaran",
                "th-date": "Tanggal",
                "th-desc": "Deskripsi / Keterangan",
                "th-cat": "Kategori",
                "th-type": "Tipe",
                "th-amount": "Nominal",
                "th-action": "Aksi",
                "type-income": "Pemasukan",
                "type-expense": "Pengeluaran",
                "pagination-info": "Menampilkan 2 dari 2 transaksi",
                "btn-prev": "Sebelumnya",
                "btn-next": "Selanjutnya",
                "modal-title": "Tambah Transaksi Baru",
                "lbl-trx-type": "Tipe Transaksi",
                "lbl-amount": "Nominal (Rp)",
                "lbl-desc": "Keterangan / Deskripsi",
                "lbl-category": "Kategori",
                "btn-cancel": "Batal",
                "btn-save": "Simpan",
                "toast-dev": "Tahap Pengembangan"
            },
            en: {
                "nav-dashboard": "Dashboard",
                "nav-transactions": "Transactions",
                "nav-inventory": "Inventory",
                "nav-profile": "Profile",
                "nav-logout": "Log Out",
                "trx-page-title": "Cash Flow Management",
                "trx-page-sub": "Manage all inbound and outbound transaction history in a structured layout.",
                "btn-add-trx": "Add Transaction",
                "filter-all": "All",
                "filter-income": "Income",
                "filter-expense": "Expense",
                "th-date": "Date",
                "th-desc": "Description / Notes",
                "th-cat": "Category",
                "th-type": "Type",
                "th-amount": "Amount",
                "th-action": "Action",
                "type-income": "Income",
                "type-expense": "Expense",
                "pagination-info": "Showing 2 of 2 transactions",
                "btn-prev": "Previous",
                "btn-next": "Next",
                "modal-title": "Add New Transaction",
                "lbl-trx-type": "Transaction Type",
                "lbl-amount": "Amount (Rp)",
                "lbl-desc": "Description",
                "lbl-category": "Category",
                "btn-cancel": "Cancel",
                "btn-save": "Save",
                "toast-dev": "Development Phase"
            }
        };

        function openTrxModal() { document.getElementById('trx-modal').classList.remove('hidden'); }
        function closeTrxModal() { document.getElementById('trx-modal').classList.add('hidden'); }

        let toastTimeout;
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

        function changeLanguage(lang) {
            localStorage.setItem('visawork_lang', lang);
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                if(translations[lang] && translations[lang][key]) {
                    element.innerHTML = translations[lang][key];
                }
            });
            const currentLangEl = document.getElementById('current-lang');
            if(currentLangEl) currentLangEl.innerText = lang.toUpperCase();
            document.documentElement.lang = lang;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedLang = localStorage.getItem('visawork_lang') || 'id';
            changeLanguage(savedLang);
        });

        function filterType(type) {
            const allBtn = document.getElementById('btn-filter-all');
            const incBtn = document.getElementById('btn-filter-income');
            const expBtn = document.getElementById('btn-filter-expense');

            [allBtn, incBtn, expBtn].forEach(b => {
                b.className = "px-4 py-1.5 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-800 transition w-1/3 md:w-auto";
            });

            if(type === 'all') allBtn.className = "px-4 py-1.5 text-xs font-medium rounded-lg bg-white text-gray-800 shadow-sm transition w-1/3 md:w-auto";
            if(type === 'income') incBtn.className = "px-4 py-1.5 text-xs font-medium rounded-lg bg-white text-emerald-600 shadow-sm transition w-1/3 md:w-auto";
            if(type === 'expense') expBtn.className = "px-4 py-1.5 text-xs font-medium rounded-lg bg-white text-orange-600 shadow-sm transition w-1/3 md:w-auto";
        }
    </script>
</x-app-layout>