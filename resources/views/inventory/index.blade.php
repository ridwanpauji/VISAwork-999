<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center font-inter max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 gap-4">
            <div>
                <h2 data-i18n="inv-page-title" class="font-semibold text-xl text-gray-800 leading-tight">
                    Manajemen Produk & Stok
                </h2>
                <p data-i18n="inv-page-sub" class="text-xs text-gray-500 mt-1">Pantau inventaris barang, penyesuaian harga jual, dan ketersediaan stok.</p>
            </div>
            
            <!-- Tombol Tambah Produk -->
            <button onclick="openInvModal()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span data-i18n="btn-add-prod">Tambah Produk</span>
            </button>
        </div>
    </x-slot>

    <div class="py-8 font-inter bg-[#F8F9FA] min-h-[calc(100vh-140px)]">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- RINGKASAN STOK CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div data-i18n="card-total-item" class="text-xs font-medium text-gray-500 mb-1">Total Jenis Produk</div>
                        <div class="text-2xl font-bold text-gray-900">18 Item</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div data-i18n="card-low-stock" class="text-xs font-medium text-gray-500 mb-1">Stok Menipis (&lt; 5)</div>
                        <div class="text-2xl font-bold text-orange-600">2 Produk</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div data-i18n="card-asset-val" class="text-xs font-medium text-gray-500 mb-1">Estimasi Nilai Aset</div>
                        <div class="text-2xl font-bold text-gray-900">Rp 42.800.000</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- TABEL DATA PRODUK -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <!-- SEARCH BAR -->
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-80">
                        <input type="text" placeholder="Cari nama produk / SKU..." class="w-full pl-9 pr-4 py-2 text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>

                    <select class="w-full md:w-48 text-sm border-gray-200 text-gray-600 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Semua Kategori</option>
                        <option value="hardware">Elektronik / Hardware</option>
                        <option value="software">Lisensi Software</option>
                        <option value="office">Peralatan Kantor</option>
                    </select>
                </div>

                <!-- TABEL DATA -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                                <th data-i18n="th-sku" class="py-3.5 px-6">SKU / Kode</th>
                                <th data-i18n="th-prod-name" class="py-3.5 px-6">Nama Produk</th>
                                <th data-i18n="th-cat" class="py-3.5 px-6">Kategori</th>
                                <th data-i18n="th-price" class="py-3.5 px-6 text-right">Harga Jual</th>
                                <th data-i18n="th-stock" class="py-3.5 px-6 text-center">Sisa Stok</th>
                                <th data-i18n="th-action" class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            
                            <!-- Item 1 -->
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 text-xs font-mono text-gray-500">PRD-001</td>
                                <td class="py-4 px-6 font-medium text-gray-900">Monitor IPS 24 Inch Enterprise</td>
                                <td class="py-4 px-6"><span class="px-2.5 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">Elektronik</span></td>
                                <td class="py-4 px-6 text-right font-semibold text-gray-900">Rp 2.100.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                        12 Unit
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button onclick="showDevAlert('Edit Produk')" class="text-gray-400 hover:text-emerald-600 p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                </td>
                            </tr>

                            <!-- Item 2 (Stok Menipis) -->
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="py-4 px-6 text-xs font-mono text-gray-500">PRD-002</td>
                                <td class="py-4 px-6 font-medium text-gray-900">Mechanical Keyboard Silent Red</td>
                                <td class="py-4 px-6"><span class="px-2.5 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">Aksesoris</span></td>
                                <td class="py-4 px-6 text-right font-semibold text-gray-900">Rp 850.000</td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100">
                                        3 Unit (Menipis)
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button onclick="showDevAlert('Edit Produk')" class="text-gray-400 hover:text-emerald-600 p-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="p-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                    <span data-i18n="pagination-info-inv">Menampilkan 2 dari 18 produk</span>
                    <div class="flex gap-1">
                        <button data-i18n="btn-prev" class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 disabled:opacity-50" disabled>Sebelumnya</button>
                        <button data-i18n="btn-next" class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 disabled:opacity-50" disabled>Selanjutnya</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH PRODUK -->
    <div id="inv-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-gray-100 relative font-inter">
            <div class="flex justify-between items-center mb-5">
                <h3 data-i18n="modal-inv-title" class="text-lg font-semibold text-gray-900">Tambah Produk Baru</h3>
                <button onclick="closeInvModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form onsubmit="event.preventDefault(); showDevAlert('Simpan Produk'); closeInvModal();" class="space-y-4">
                <!-- Kode SKU -->
                <div>
                    <label data-i18n="lbl-sku" class="block text-xs font-medium text-gray-700 mb-1">Kode Produk / SKU</label>
                    <input type="text" placeholder="Contoh: PRD-003" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Nama Produk -->
                <div>
                    <label data-i18n="lbl-prod-name" class="block text-xs font-medium text-gray-700 mb-1">Nama Produk</label>
                    <input type="text" placeholder="Masukkan nama barang" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Harga & Stok (2 Kolom) -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label data-i18n="lbl-price" class="block text-xs font-medium text-gray-700 mb-1">Harga Jual (Rp)</label>
                        <input type="number" placeholder="0" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label data-i18n="lbl-stock" class="block text-xs font-medium text-gray-700 mb-1">Jumlah Stok Initial</label>
                        <input type="number" placeholder="0" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                </div>

                <!-- Kategori -->
                <div>
                    <label data-i18n="lbl-category" class="block text-xs font-medium text-gray-700 mb-1">Kategori</label>
                    <select class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <option>Elektronik</option>
                        <option>Aksesoris</option>
                        <option>Lisensi Software</option>
                        <option>Lain-Lain</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="pt-3 flex gap-3">
                    <button type="button" onclick="closeInvModal()" data-i18n="btn-cancel" class="w-1/2 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50">Batal</button>
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
                "inv-page-title": "Manajemen Produk & Stok",
                "inv-page-sub": "Pantau inventaris barang, penyesuaian harga jual, dan ketersediaan stok.",
                "btn-add-prod": "Tambah Produk",
                "card-total-item": "Total Jenis Produk",
                "card-low-stock": "Stok Menipis (< 5)",
                "card-asset-val": "Estimasi Nilai Aset",
                "th-sku": "SKU / Kode",
                "th-prod-name": "Nama Produk",
                "th-cat": "Kategori",
                "th-price": "Harga Jual",
                "th-stock": "Sisa Stok",
                "th-action": "Aksi",
                "pagination-info-inv": "Menampilkan 2 dari 18 produk",
                "btn-prev": "Sebelumnya",
                "btn-next": "Selanjutnya",
                "modal-inv-title": "Tambah Produk Baru",
                "lbl-sku": "Kode Produk / SKU",
                "lbl-prod-name": "Nama Produk",
                "lbl-price": "Harga Jual (Rp)",
                "lbl-stock": "Jumlah Stok Initial",
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
                "inv-page-title": "Product & Stock Management",
                "inv-page-sub": "Monitor item inventory, selling price adjustments, and stock availability.",
                "btn-add-prod": "Add Product",
                "card-total-item": "Total Product Types",
                "card-low-stock": "Low Stock (< 5)",
                "card-asset-val": "Estimated Asset Value",
                "th-sku": "SKU / Code",
                "th-prod-name": "Product Name",
                "th-cat": "Category",
                "th-price": "Selling Price",
                "th-stock": "Remaining Stock",
                "th-action": "Action",
                "pagination-info-inv": "Showing 2 of 18 products",
                "btn-prev": "Previous",
                "btn-next": "Next",
                "modal-inv-title": "Add New Product",
                "lbl-sku": "Product Code / SKU",
                "lbl-prod-name": "Product Name",
                "lbl-price": "Selling Price (Rp)",
                "lbl-stock": "Initial Stock Quantity",
                "lbl-category": "Category",
                "btn-cancel": "Cancel",
                "btn-save": "Save",
                "toast-dev": "Development Phase"
            }
        };

        function openInvModal() { document.getElementById('inv-modal').classList.remove('hidden'); }
        function closeInvModal() { document.getElementById('inv-modal').classList.add('hidden'); }

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
    </script>
</x-app-layout>