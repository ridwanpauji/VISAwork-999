<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    <!-- Chart.js CDN for interactive cash flow statistics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center font-inter max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 gap-3">
            <div>
                <h2 data-i18n="dash-title" class="font-semibold text-xl text-slate-800 leading-tight">
                    Ikhtisar Keuangan
                </h2>
                <p class="text-xs text-slate-500 mt-1">Pantau performa arus kas, pemasukan, pengeluaran, dan tren bisnis Anda.</p>
            </div>
            <div class="text-xs sm:text-sm text-slate-500 font-medium bg-slate-50 border border-slate-200/80 px-3.5 py-1.5 rounded-lg shadow-2xs">
                <span data-i18n="dash-welcome">Selamat datang,</span> <span class="text-emerald-700 font-semibold">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 font-inter bg-slate-50/70 min-h-[calc(100vh-140px)]">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Alert -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-2xs">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 font-bold">&times;</button>
                </div>
            @endif
            
            <!-- 1. BARIS KARTU RINGKASAN SALDO & ARUS KAS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Kartu Saldo Utama -->
                <div class="bg-white rounded-xl p-5 shadow-2xs border border-slate-200/80 flex flex-col justify-between relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-2">
                        <span data-i18n="card1-title" class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Saldo Kas Aktif</span>
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                    </div>
                    <div class="text-2xl lg:text-3xl font-bold {{ $activeBalance >= 0 ? 'text-slate-900' : 'text-rose-600' }} my-1.5">
                        Rp {{ number_format($activeBalance, 0, ',', '.') }}
                    </div>
                    <div class="flex items-center text-xs font-medium text-slate-500 pt-2 border-t border-slate-100 mt-2">
                        <span class="inline-block w-2 h-2 rounded-full {{ $activeBalance >= 0 ? 'bg-emerald-500' : 'bg-rose-500' }} mr-2"></span>
                        <span data-i18n="card1-sub">Akumulasi seluruh arus kas masuk & keluar</span>
                    </div>
                </div>

                <!-- Kartu Pemasukan -->
                <div class="bg-white rounded-xl p-5 shadow-2xs border border-slate-200/80 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <span data-i18n="card2-title" class="text-xs font-medium text-slate-500 uppercase tracking-wider">Pemasukan Bulan Ini</span>
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                        </div>
                    </div>
                    <div class="text-2xl lg:text-3xl font-bold text-emerald-600 my-1.5">
                        + Rp {{ number_format($thisMonthIncome, 0, ',', '.') }}
                    </div>
                    <div class="text-xs text-slate-400 pt-2 border-t border-slate-100 mt-2 flex items-center justify-between">
                        <span>Periode {{ now()->translatedFormat('F Y') }}</span>
                        <span class="text-emerald-700 font-medium">Kas Masuk</span>
                    </div>
                </div>

                <!-- Kartu Pengeluaran -->
                <div class="bg-white rounded-xl p-5 shadow-2xs border border-slate-200/80 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <span data-i18n="card3-title" class="text-xs font-medium text-slate-500 uppercase tracking-wider">Pengeluaran Bulan Ini</span>
                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                        </div>
                    </div>
                    <div class="text-2xl lg:text-3xl font-bold text-orange-600 my-1.5">
                        - Rp {{ number_format($thisMonthExpense, 0, ',', '.') }}
                    </div>
                    @php
                        $pct = ($thisMonthIncome > 0) ? min(100, round(($thisMonthExpense / $thisMonthIncome) * 100)) : ($thisMonthExpense > 0 ? 100 : 0);
                    @endphp
                    <div class="pt-2 border-t border-slate-100 mt-2">
                        <div class="w-full bg-slate-100 rounded-full h-1.5 mb-1.5 overflow-hidden">
                            <div class="bg-orange-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $pct }}%"></div>
                        </div>
                        <div class="text-[11px] text-slate-400 flex justify-between">
                            <span>Rasio Beban</span>
                            <span class="font-medium text-slate-600">{{ $pct }}% dari pemasukan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. BARIS KONTEN UTAMA (GRAFIK PROFESIONAL & AKSI) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Kiri: Visualisasi Grafik Arus Kas -->
                <div class="lg:col-span-2 bg-white rounded-xl p-6 shadow-2xs border border-slate-200/80 flex flex-col justify-between">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                        <div>
                            <h3 data-i18n="chart-title" class="font-semibold text-slate-800 text-base">
                                Analisis Arus Kas Masuk vs Keluar
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">Grafik perbandingan volume debit dan kredit keuangan usaha.</p>
                        </div>
                        
                        <!-- Filter Periode Grafik -->
                        <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-1 bg-slate-100/80 p-1 rounded-lg border border-slate-200/60">
                            <a href="{{ route('dashboard', ['range' => '7days']) }}" class="px-2.5 py-1 text-xs font-medium rounded-md transition {{ $range === '7days' ? 'bg-white text-slate-800 shadow-2xs' : 'text-slate-500 hover:text-slate-800' }}">7 Hari</a>
                            <a href="{{ route('dashboard', ['range' => '30days']) }}" class="px-2.5 py-1 text-xs font-medium rounded-md transition {{ $range === '30days' ? 'bg-white text-slate-800 shadow-2xs' : 'text-slate-500 hover:text-slate-800' }}">30 Hari</a>
                            <a href="{{ route('dashboard', ['range' => 'this_year']) }}" class="px-2.5 py-1 text-xs font-medium rounded-md transition {{ $range === 'this_year' ? 'bg-white text-slate-800 shadow-2xs' : 'text-slate-500 hover:text-slate-800' }}">Tahun Ini</a>
                        </form>
                    </div>

                    <!-- Canvas Area Grafik -->
                    <div class="w-full h-72 relative">
                        <canvas id="cashflowChart"></canvas>
                    </div>

                    <!-- Legenda & Keterangan Bawah -->
                    <div class="flex items-center justify-between text-xs text-slate-500 pt-4 mt-2 border-t border-slate-100">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-sm bg-emerald-500"></span>
                                <span class="font-medium text-slate-600">Pemasukan (Kredit)</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-sm bg-orange-500"></span>
                                <span class="font-medium text-slate-600">Pengeluaran (Debit)</span>
                            </div>
                        </div>
                        <span class="text-[11px] text-slate-400 hidden sm:inline">Data sinkron otomatis</span>
                    </div>
                </div>

                <!-- Kanan: Tombol Aksi & Riwayat Transaksi -->
                <div class="space-y-6">
                    <div class="bg-white rounded-xl p-5 shadow-2xs border border-slate-200/80">
                        <h3 data-i18n="action-title" class="font-semibold text-slate-800 text-sm mb-3">Aksi Cepat Operasional</h3>
                        <div class="grid grid-cols-2 gap-2.5">
                            <button onclick="openTrxModalWithType('income')" class="flex flex-col items-center justify-center p-3 rounded-lg bg-emerald-50/80 hover:bg-emerald-100/70 text-emerald-800 transition border border-emerald-200/70 cursor-pointer">
                                <svg class="w-5 h-5 mb-1 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <span data-i18n="act-in" class="text-xs font-medium">Catat Pemasukan</span>
                            </button>
                            <button onclick="openTrxModalWithType('expense')" class="flex flex-col items-center justify-center p-3 rounded-lg bg-orange-50/80 hover:bg-orange-100/70 text-orange-800 transition border border-orange-200/70 cursor-pointer">
                                <svg class="w-5 h-5 mb-1 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                <span data-i18n="act-out" class="text-xs font-medium">Catat Beban / Biaya</span>
                            </button>
                            <a href="{{ route('inventory.index') }}" class="col-span-2 flex items-center justify-center p-2.5 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-700 transition border border-slate-200 gap-2 cursor-pointer text-xs font-medium">
                                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                <span>Kelola Katalog & Stok Produk</span>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-5 shadow-2xs border border-slate-200/80">
                        <div class="flex justify-between items-center mb-3 pb-2 border-b border-slate-100">
                            <h3 data-i18n="trx-title" class="font-semibold text-slate-800 text-sm">Transaksi Terakhir</h3>
                            <a href="{{ route('transactions.index') }}" data-i18n="trx-all" class="text-xs font-medium text-emerald-700 hover:text-emerald-800">Lihat Semua &rarr;</a>
                        </div>
                        <div class="divide-y divide-slate-100">
                            @forelse($recentTransactions as $item)
                                <div class="py-2.5 flex justify-between items-center first:pt-0 last:pb-0">
                                    <div class="flex items-center gap-3">
                                        @if($item->type === 'income')
                                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-xs font-semibold text-slate-800 line-clamp-1">{{ $item->description }}</div>
                                            <div class="text-[11px] text-slate-400">{{ \Carbon\Carbon::parse($item->transaction_date)->translatedFormat('d M Y') }} • {{ $item->category }}</div>
                                        </div>
                                    </div>
                                    <div class="text-xs font-bold shrink-0 ml-2 {{ $item->type === 'income' ? 'text-emerald-600' : 'text-slate-800' }}">
                                        {{ $item->type === 'income' ? '+' : '-' }} Rp {{ number_format($item->amount, 0, ',', '.') }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-slate-400 text-xs">
                                    Belum ada histori transaksi.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FORM TRANSAKSI CEPAT DARI DASBOR -->
    <div id="quick-trx-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/40 backdrop-blur-xs flex justify-center items-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl border border-slate-200 relative font-inter">
            <div class="flex justify-between items-center mb-5 pb-3 border-b border-slate-100">
                <h3 id="quick-trx-title" class="text-base font-semibold text-slate-900">Catat Mutasi Keuangan</h3>
                <button onclick="closeQuickTrxModal()" class="text-slate-400 hover:text-slate-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
            </div>

            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-4">
                @csrf
                <!-- Tipe -->
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Tipe Transaksi</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label id="quick-label-income" class="flex items-center justify-center p-2.5 border border-emerald-300 rounded-lg bg-emerald-50 text-emerald-800 text-xs font-semibold cursor-pointer transition">
                            <input type="radio" name="type" value="income" id="quick-type-income" class="hidden" checked onchange="updateQuickTypeStyles()"> <span>Pemasukan (+)</span>
                        </label>
                        <label id="quick-label-expense" class="flex items-center justify-center p-2.5 border border-slate-200 rounded-lg text-slate-600 text-xs font-medium cursor-pointer hover:bg-slate-50 transition">
                            <input type="radio" name="type" value="expense" id="quick-type-expense" class="hidden" onchange="updateQuickTypeStyles()"> <span>Pengeluaran (-)</span>
                        </label>
                    </div>
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Tanggal</label>
                    <input type="date" name="transaction_date" value="{{ date('Y-m-d') }}" class="w-full text-xs border-slate-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Nominal -->
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Nominal (Rp)</label>
                    <input type="number" step="any" name="amount" placeholder="Contoh: 500000" class="w-full text-xs border-slate-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Keterangan / Deskripsi</label>
                    <input type="text" name="description" placeholder="Misal: Pembayaran Jasa / Belanja Operasional" class="w-full text-xs border-slate-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-xs font-medium text-slate-700 mb-1">Kategori</label>
                    <input type="text" list="quick-cat-options" name="category" placeholder="Pilih atau ketik kategori" class="w-full text-xs border-slate-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                    <datalist id="quick-cat-options">
                        <option value="Operasional">
                        <option value="Penjualan / Jasa">
                        <option value="Gaji / Honor">
                        <option value="Bahan Baku">
                        <option value="Investasi">
                        <option value="Lain-Lain">
                    </datalist>
                </div>

                <div class="pt-2 flex gap-3">
                    <button type="button" onclick="closeQuickTrxModal()" class="w-1/2 py-2 border border-slate-200 rounded-lg text-xs font-medium text-slate-600 hover:bg-slate-50 cursor-pointer">Batal</button>
                    <button type="submit" class="w-1/2 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-semibold shadow-2xs cursor-pointer">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT CHART & MULTI-BAHASA -->
    <script>
        function openTrxModalWithType(type) {
            if (type === 'expense') {
                document.getElementById('quick-type-expense').checked = true;
            } else {
                document.getElementById('quick-type-income').checked = true;
            }
            updateQuickTypeStyles();
            document.getElementById('quick-trx-modal').classList.remove('hidden');
        }

        function closeQuickTrxModal() {
            document.getElementById('quick-trx-modal').classList.add('hidden');
        }

        function updateQuickTypeStyles() {
            const isIncome = document.getElementById('quick-type-income').checked;
            const lblInc = document.getElementById('quick-label-income');
            const lblExp = document.getElementById('quick-label-expense');
            if (isIncome) {
                lblInc.className = "flex items-center justify-center p-2.5 border border-emerald-300 rounded-lg bg-emerald-50 text-emerald-800 text-xs font-semibold cursor-pointer transition";
                lblExp.className = "flex items-center justify-center p-2.5 border border-slate-200 rounded-lg text-slate-600 text-xs font-medium cursor-pointer hover:bg-slate-50 transition";
            } else {
                lblExp.className = "flex items-center justify-center p-2.5 border border-orange-300 rounded-lg bg-orange-50 text-orange-800 text-xs font-semibold cursor-pointer transition";
                lblInc.className = "flex items-center justify-center p-2.5 border border-slate-200 rounded-lg text-slate-600 text-xs font-medium cursor-pointer hover:bg-slate-50 transition";
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('cashflowChart').getContext('2d');
            const chartDates = @json($chartDates);
            const chartIncome = @json($chartIncome);
            const chartExpense = @json($chartExpense);
            const maxVal = Math.max(...chartIncome, ...chartExpense, 0);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartDates,
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: chartIncome,
                            backgroundColor: '#10B981',
                            hoverBackgroundColor: '#059669',
                            borderRadius: 4,
                            maxBarThickness: 28
                        },
                        {
                            label: 'Pengeluaran',
                            data: chartExpense,
                            backgroundColor: '#F97316',
                            hoverBackgroundColor: '#EA580C',
                            borderRadius: 4,
                            maxBarThickness: 28
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Menggunakan custom legend di HTML agar lebih rapi
                        },
                        tooltip: {
                            backgroundColor: '#0F172A',
                            titleFont: { family: 'Inter', size: 12 },
                            bodyFont: { family: 'Inter', size: 12 },
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    let val = context.parsed.y || 0;
                                    return context.dataset.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(val);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: maxVal > 0 ? maxVal * 1.15 : 1000000,
                            ticks: {
                                callback: function(value) {
                                    if(value === 0) return '0';
                                    if(value >= 1000000) return (value / 1000000).toLocaleString('id-ID') + ' jt';
                                    if(value >= 1000) return (value / 1000).toLocaleString('id-ID') + ' rb';
                                    return 'Rp ' + value;
                                },
                                font: { family: 'Inter', size: 11 },
                                color: '#64748B'
                            },
                            grid: {
                                color: '#F1F5F9'
                            },
                            border: {
                                dash: [4, 4]
                            }
                        },
                        x: {
                            ticks: {
                                font: { family: 'Inter', size: 11 },
                                color: '#64748B'
                            },
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
