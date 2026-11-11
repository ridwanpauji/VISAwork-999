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
            <button onclick="openInvModal()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span data-i18n="btn-add-prod">Tambah Produk</span>
            </button>
        </div>
    </x-slot>

    <div class="py-8 font-inter bg-[#F8F9FA] min-h-[calc(100vh-140px)]">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Alert -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 font-bold">&times;</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm shadow-sm">
                    <p class="font-semibold mb-1">Ada kesalahan penginputan:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- RINGKASAN STOK CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div data-i18n="card-total-item" class="text-xs font-medium text-gray-500 mb-1">Total Jenis Produk</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalItems }} Item</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div data-i18n="card-low-stock" class="text-xs font-medium text-gray-500 mb-1">Stok Menipis (&lt; 5)</div>
                        <div class="text-2xl font-bold {{ $lowStockCount > 0 ? 'text-orange-600' : 'text-gray-900' }}">{{ $lowStockCount }} Produk</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <div data-i18n="card-asset-val" class="text-xs font-medium text-gray-500 mb-1">Estimasi Nilai Aset</div>
                        <div class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalAssetValue, 0, ',', '.') }}</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- TABEL DATA PRODUK -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <!-- SEARCH BAR & FILTER -->
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <form method="GET" action="{{ route('inventory.index') }}" class="relative w-full md:w-80">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk / SKU..." class="w-full pl-9 pr-4 py-2 text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>

                    <form method="GET" action="{{ route('inventory.index') }}" class="w-full md:w-auto">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="category" onchange="this.form.submit()" class="w-full md:w-48 text-sm border-gray-200 text-gray-600 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 cursor-pointer">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </form>
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
                            @forelse($products as $product)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-xs font-mono text-gray-500">{{ $product->sku ?? ('PRD-' . $product->id) }}</td>
                                    <td class="py-4 px-6 font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="py-4 px-6"><span class="px-2.5 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">{{ $product->category ?? 'Umum' }}</span></td>
                                    <td class="py-4 px-6 text-right font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="py-4 px-6 text-center">
                                        @if($product->stock < 5)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                                                {{ $product->stock }} Unit
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                                {{ $product->stock }} Unit
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="openEditInvModal({{ json_encode($product) }})" class="text-gray-400 hover:text-emerald-600 p-1" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                            <form action="{{ route('inventory.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-rose-600 p-1" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        Belum ada produk terdaftar. Klik tombol "Tambah Produk" untuk memulai.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- FOOTER TABEL / PAGINATION -->
                <div class="p-4 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-500 gap-3">
                    <span>Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk</span>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH / EDIT PRODUK -->
    <div id="inv-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-gray-100 relative font-inter">
            <div class="flex justify-between items-center mb-5">
                <h3 id="inv-modal-title" class="text-lg font-semibold text-gray-900">Tambah Produk Baru</h3>
                <button onclick="closeInvModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form id="inv-form" method="POST" action="{{ route('inventory.store') }}" class="space-y-4">
                @csrf
                <div id="inv-method-spoof"></div>

                <!-- SKU & Nama -->
                <div class="grid grid-cols-3 gap-3">
                    <div class="col-span-1">
                        <label class="block text-xs font-medium text-gray-700 mb-1">SKU / Kode</label>
                        <input type="text" name="sku" id="inv-sku" placeholder="PRD-001" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div class="col-span-2">
                        <label class="block text-xs font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" name="name" id="inv-name" placeholder="Nama barang" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" list="inv-cat-options" name="category" id="inv-category" placeholder="Elektronik, ATK, Jasa, dll." class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    <datalist id="inv-cat-options">
                        <option value="Elektronik / Hardware">
                        <option value="Lisensi Software">
                        <option value="Peralatan Kantor">
                        <option value="Konsumsi">
                        <option value="Lain-Lain">
                    </datalist>
                </div>

                <!-- Harga & Stok -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Harga Jual (Rp)</label>
                        <input type="number" step="any" name="price" id="inv-price" placeholder="0" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Stok Awal</label>
                        <input type="number" name="stock" id="inv-stock" placeholder="0" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-3 flex gap-3">
                    <button type="button" onclick="closeInvModal()" class="w-1/2 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 cursor-pointer">Batal</button>
                    <button type="submit" class="w-1/2 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium shadow-sm cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT EVENT HANDLER -->
    <script>
        function openInvModal() { 
            const form = document.getElementById('inv-form');
            form.action = "{{ route('inventory.store') }}";
            document.getElementById('inv-method-spoof').innerHTML = '';
            document.getElementById('inv-modal-title').innerText = 'Tambah Produk Baru';
            document.getElementById('inv-sku').value = '';
            document.getElementById('inv-name').value = '';
            document.getElementById('inv-category').value = '';
            document.getElementById('inv-price').value = '';
            document.getElementById('inv-stock').value = '';
            document.getElementById('inv-modal').classList.remove('hidden'); 
        }

        function openEditInvModal(product) {
            const form = document.getElementById('inv-form');
            form.action = `/inventory/${product.id}`;
            document.getElementById('inv-method-spoof').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('inv-modal-title').innerText = 'Edit Produk';
            document.getElementById('inv-sku').value = product.sku || '';
            document.getElementById('inv-name').value = product.name;
            document.getElementById('inv-category').value = product.category || '';
            document.getElementById('inv-price').value = product.price;
            document.getElementById('inv-stock').value = product.stock;
            document.getElementById('inv-modal').classList.remove('hidden');
        }

        function closeInvModal() { document.getElementById('inv-modal').classList.add('hidden'); }
    </script>
</x-app-layout>
