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
            <button onclick="openTrxModal()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span data-i18n="btn-add-trx">Tambah Transaksi</span>
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
            
            <!-- KONTEN UTAMA: TABEL TRANSAKSI -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <!-- FILTER & SEARCH BAR -->
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    
                    <!-- Filter Tipe Transaksi -->
                    <div class="flex items-center bg-gray-100 p-1 rounded-xl w-full md:w-auto">
                        <a href="{{ route('transactions.index', array_merge(request()->query(), ['type' => ''])) }}" id="btn-filter-all" data-i18n="filter-all" class="px-4 py-1.5 text-xs font-medium rounded-lg text-center transition w-1/3 md:w-auto {{ !request('type') ? 'bg-white text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-800' }}">
                            Semua
                        </a>
                        <a href="{{ route('transactions.index', array_merge(request()->query(), ['type' => 'income'])) }}" id="btn-filter-income" data-i18n="filter-income" class="px-4 py-1.5 text-xs font-medium rounded-lg text-center transition w-1/3 md:w-auto {{ request('type') === 'income' ? 'bg-white text-emerald-600 shadow-sm font-semibold' : 'text-gray-500 hover:text-gray-800' }}">
                            Pemasukan
                        </a>
                        <a href="{{ route('transactions.index', array_merge(request()->query(), ['type' => 'expense'])) }}" id="btn-filter-expense" data-i18n="filter-expense" class="px-4 py-1.5 text-xs font-medium rounded-lg text-center transition w-1/3 md:w-auto {{ request('type') === 'expense' ? 'bg-white text-orange-600 shadow-sm font-semibold' : 'text-gray-500 hover:text-gray-800' }}">
                            Pengeluaran
                        </a>
                    </div>

                    <!-- Input Pencarian -->
                    <form method="GET" action="{{ route('transactions.index') }}" class="relative w-full md:w-72">
                        @if(request('type'))
                            <input type="hidden" name="type" value="{{ request('type') }}">
                        @endif
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari transaksi..." class="w-full pl-9 pr-4 py-2 text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </form>
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
                            @forelse($transactions as $trx)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-gray-500 text-xs">{{ $trx->transaction_date ? \Carbon\Carbon::parse($trx->transaction_date)->translatedFormat('d M Y') : '-' }}</td>
                                    <td class="py-4 px-6 font-medium text-gray-900">{{ $trx->description }}</td>
                                    <td class="py-4 px-6"><span class="px-2.5 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">{{ $trx->category }}</span></td>
                                    <td class="py-4 px-6">
                                        @if($trx->type === 'income')
                                            <span data-i18n="type-income" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                Pemasukan
                                            </span>
                                        @else
                                            <span data-i18n="type-expense" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100">
                                                Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right font-semibold {{ $trx->type === 'income' ? 'text-emerald-600' : 'text-gray-800' }}">
                                        {{ $trx->type === 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="openEditModal({{ json_encode($trx) }})" class="text-gray-400 hover:text-emerald-600 p-1" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </button>
                                            <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
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
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Belum ada data transaksi. Silakan klik tombol "Tambah Transaksi".
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- FOOTER TABEL / PAGINATION -->
                <div class="p-4 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-500 gap-3">
                    <span>Menampilkan {{ $transactions->firstItem() ?? 0 }} - {{ $transactions->lastItem() ?? 0 }} dari {{ $transactions->total() }} transaksi</span>
                    <div>
                        {{ $transactions->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH / EDIT TRANSAKSI -->
    <div id="trx-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900/40 backdrop-blur-sm flex justify-center items-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-gray-100 relative font-inter">
            <div class="flex justify-between items-center mb-5">
                <h3 id="trx-modal-title" class="text-lg font-semibold text-gray-900">Tambah Transaksi Baru</h3>
                <button onclick="closeTrxModal()" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form id="trx-form" method="POST" action="{{ route('transactions.store') }}" class="space-y-4">
                @csrf
                <div id="method-spoof"></div>

                <!-- Tipe -->
                <div>
                    <label data-i18n="lbl-trx-type" class="block text-xs font-medium text-gray-700 mb-1">Tipe Transaksi</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label id="label-type-income" class="flex items-center justify-center p-2.5 border border-emerald-200 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-medium cursor-pointer transition">
                            <input type="radio" name="type" value="income" id="type-income-radio" class="hidden" checked onchange="updateTypeRadioStyles()"> <span data-i18n="type-income">Pemasukan</span>
                        </label>
                        <label id="label-type-expense" class="flex items-center justify-center p-2.5 border border-gray-200 rounded-lg text-gray-600 text-xs font-medium cursor-pointer hover:bg-gray-50 transition">
                            <input type="radio" name="type" value="expense" id="type-expense-radio" class="hidden" onchange="updateTypeRadioStyles()"> <span data-i18n="type-expense">Pengeluaran</span>
                        </label>
                    </div>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="transaction_date" id="trx-date" value="{{ date('Y-m-d') }}" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Nominal -->
                <div>
                    <label data-i18n="lbl-amount" class="block text-xs font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                    <input type="number" step="any" name="amount" id="trx-amount" placeholder="Contoh: 500000" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label data-i18n="lbl-desc" class="block text-xs font-medium text-gray-700 mb-1">Keterangan / Deskripsi</label>
                    <input type="text" name="description" id="trx-desc" placeholder="Masukkan rincian transaksi" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label data-i18n="lbl-category" class="block text-xs font-medium text-gray-700 mb-1">Kategori</label>
                    <input type="text" list="category-options" name="category" id="trx-category" placeholder="Pilih atau ketik kategori" class="w-full text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                    <datalist id="category-options">
                        <option value="Operasional">
                        <option value="Penjualan / Jasa">
                        <option value="Gaji / Honor">
                        <option value="Kebutuhan">
                        <option value="Investasi">
                        <option value="Lain-Lain">
                    </datalist>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-3 flex gap-3">
                    <button type="button" onclick="closeTrxModal()" data-i18n="btn-cancel" class="w-1/2 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 cursor-pointer">Batal</button>
                    <button type="submit" id="btn-submit-trx" data-i18n="btn-save" class="w-1/2 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium shadow-sm cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT EVENT HANDLER -->
    <script>
        function openTrxModal() { 
            const form = document.getElementById('trx-form');
            form.action = "{{ route('transactions.store') }}";
            document.getElementById('method-spoof').innerHTML = '';
            document.getElementById('trx-modal-title').innerText = 'Tambah Transaksi Baru';
            document.getElementById('type-income-radio').checked = true;
            document.getElementById('trx-amount').value = '';
            document.getElementById('trx-desc').value = '';
            document.getElementById('trx-category').value = '';
            document.getElementById('trx-date').value = "{{ date('Y-m-d') }}";
            updateTypeRadioStyles();
            document.getElementById('trx-modal').classList.remove('hidden'); 
        }

        function openEditModal(trx) {
            const form = document.getElementById('trx-form');
            form.action = `/transactions/${trx.id}`;
            document.getElementById('method-spoof').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('trx-modal-title').innerText = 'Edit Transaksi';
            
            if (trx.type === 'expense') {
                document.getElementById('type-expense-radio').checked = true;
            } else {
                document.getElementById('type-income-radio').checked = true;
            }
            updateTypeRadioStyles();

            document.getElementById('trx-amount').value = trx.amount;
            document.getElementById('trx-desc').value = trx.description;
            document.getElementById('trx-category').value = trx.category;
            
            if (trx.transaction_date) {
                const dt = new Date(trx.transaction_date);
                const yyyy = dt.getFullYear();
                const mm = String(dt.getMonth() + 1).padStart(2, '0');
                const dd = String(dt.getDate()).padStart(2, '0');
                document.getElementById('trx-date').value = `${yyyy}-${mm}-${dd}`;
            }

            document.getElementById('trx-modal').classList.remove('hidden');
        }

        function updateTypeRadioStyles() {
            const isIncome = document.getElementById('type-income-radio').checked;
            const lblInc = document.getElementById('label-type-income');
            const lblExp = document.getElementById('label-type-expense');
            if (isIncome) {
                lblInc.className = "flex items-center justify-center p-2.5 border border-emerald-200 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-medium cursor-pointer transition";
                lblExp.className = "flex items-center justify-center p-2.5 border border-gray-200 rounded-lg text-gray-600 text-xs font-medium cursor-pointer hover:bg-gray-50 transition";
            } else {
                lblExp.className = "flex items-center justify-center p-2.5 border border-orange-200 rounded-lg bg-orange-50 text-orange-700 text-xs font-medium cursor-pointer transition";
                lblInc.className = "flex items-center justify-center p-2.5 border border-gray-200 rounded-lg text-gray-600 text-xs font-medium cursor-pointer hover:bg-gray-50 transition";
            }
        }

        function closeTrxModal() { document.getElementById('trx-modal').classList.add('hidden'); }
    </script>
</x-app-layout>
