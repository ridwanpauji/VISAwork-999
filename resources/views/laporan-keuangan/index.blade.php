<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center font-inter max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Keuangan</h2>
                <p class="text-xs text-gray-500 mt-1">Ringkasan dan detail laporan arus kas berdasarkan periode yang dipilih.</p>
            </div>
            <!-- Tombol Download -->
            <div class="flex items-center gap-3">
                <a href="{{ route('laporan.download-pdf', array_merge(request()->query())) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download PDF
                </a>
                <a href="{{ route('laporan.download-excel', array_merge(request()->query())) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Download Excel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 font-inter bg-[#F8F9FA] min-h-[calc(100vh-140px)]">
        <div class="max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- FILTER PERIODE -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <form method="GET" action="{{ route('laporan.index') }}" id="filter-form">
                    <div class="flex flex-col lg:flex-row items-start lg:items-end gap-4">

                        <!-- Filter Cepat Periode -->
                        <div class="flex-1">
                            <label class="block text-xs font-medium text-gray-700 mb-2">Pilih Periode</label>
                            <div class="flex flex-wrap items-center gap-2">
                                @foreach([
                                    'today'      => 'Hari Ini',
                                    'this_week'  => 'Minggu Ini',
                                    'this_month' => 'Bulan Ini',
                                    'last_month' => 'Bulan Lalu',
                                    'this_year'  => 'Tahun Ini',
                                    'all'        => 'Semua',
                                    'custom'     => 'Custom',
                                ] as $value => $label)
                                    <button type="button" onclick="setPeriod('{{ $value }}')"
                                        class="period-btn px-3 py-1.5 text-xs font-medium rounded-lg border transition {{ $period === $value ? 'bg-emerald-600 text-white border-emerald-600' : 'bg-white text-gray-600 border-gray-200 hover:border-emerald-300 hover:text-emerald-600' }}">
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>
                            <input type="hidden" name="period" id="period-input" value="{{ $period }}">
                        </div>

                        <!-- Custom Date Range -->
                        <div id="custom-date-section" class="{{ $period === 'custom' ? 'flex' : 'hidden' }} items-end gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Dari Tanggal</label>
                                <input type="date" name="date_from" value="{{ $dateFrom }}"
                                    class="text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                                <input type="date" name="date_to" value="{{ $dateTo }}"
                                    class="text-sm border-gray-200 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                        </div>

                        <!-- Tombol Terapkan -->
                        <button type="submit"
                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- KARTU RINGKASAN -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <!-- Total Pemasukan -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-emerald-50">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total Pemasukan</p>
                        <p class="text-xl font-bold text-emerald-600 mt-0.5">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Total Pengeluaran -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 rounded-xl bg-orange-50">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total Pengeluaran</p>
                        <p class="text-xl font-bold text-orange-500 mt-0.5">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Saldo Bersih -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center gap-4">
                    <div class="p-3 rounded-xl {{ $totalSaldo >= 0 ? 'bg-blue-50' : 'bg-red-50' }}">
                        <svg class="w-6 h-6 {{ $totalSaldo >= 0 ? 'text-blue-600' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Saldo Bersih</p>
                        <p class="text-xl font-bold {{ $totalSaldo >= 0 ? 'text-blue-600' : 'text-red-500' }} mt-0.5">
                            {{ $totalSaldo >= 0 ? '' : '-' }}Rp {{ number_format(abs($totalSaldo), 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- TABEL TRANSAKSI -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm">Detail Transaksi</h3>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $transactions->count() }} transaksi ditemukan</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                                <th class="py-3.5 px-6 w-10">No</th>
                                <th class="py-3.5 px-6">Tanggal</th>
                                <th class="py-3.5 px-6">Deskripsi / Keterangan</th>
                                <th class="py-3.5 px-6">Kategori</th>
                                <th class="py-3.5 px-6">Tipe</th>
                                <th class="py-3.5 px-6 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                            @forelse($transactions as $index => $trx)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6 text-gray-400 text-xs">{{ $index + 1 }}</td>
                                    <td class="py-4 px-6 text-gray-500 text-xs">
                                        {{ $trx->transaction_date ? \Carbon\Carbon::parse($trx->transaction_date)->translatedFormat('d M Y') : '-' }}
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-900">{{ $trx->description }}</td>
                                    <td class="py-4 px-6">
                                        <span class="px-2.5 py-1 text-xs bg-gray-100 text-gray-600 rounded-md">{{ $trx->category }}</span>
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($trx->type === 'income')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                Pemasukan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100">
                                                Pengeluaran
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right font-semibold {{ $trx->type === 'income' ? 'text-emerald-600' : 'text-gray-800' }}">
                                        {{ $trx->type === 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-16 text-center text-gray-400">
                                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-sm">Tidak ada data transaksi untuk periode ini.</p>
                                        <p class="text-xs text-gray-400 mt-1">Coba ubah filter periode.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($transactions->count() > 0)
                        <tfoot>
                            <tr class="bg-gray-50 border-t-2 border-gray-200">
                                <td colspan="5" class="py-3.5 px-6 font-semibold text-gray-700 text-sm">Total Pemasukan</td>
                                <td class="py-3.5 px-6 text-right font-bold text-emerald-600">+ Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="bg-gray-50 border-t border-gray-100">
                                <td colspan="5" class="py-3.5 px-6 font-semibold text-gray-700 text-sm">Total Pengeluaran</td>
                                <td class="py-3.5 px-6 text-right font-bold text-orange-500">- Rp {{ number_format($totalExpense, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-t-2 border-gray-200 {{ $totalSaldo >= 0 ? 'bg-emerald-50' : 'bg-red-50' }}">
                                <td colspan="5" class="py-4 px-6 font-bold text-gray-800 text-sm">Saldo Bersih</td>
                                <td class="py-4 px-6 text-right font-bold text-lg {{ $totalSaldo >= 0 ? 'text-emerald-700' : 'text-red-600' }}">
                                    {{ $totalSaldo >= 0 ? '' : '-' }}Rp {{ number_format(abs($totalSaldo), 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        function setPeriod(value) {
            document.getElementById('period-input').value = value;

            // Update active button styles
            document.querySelectorAll('.period-btn').forEach(btn => {
                btn.className = btn.className
                    .replace('bg-emerald-600 text-white border-emerald-600', '')
                    .replace('bg-white text-gray-600 border-gray-200 hover:border-emerald-300 hover:text-emerald-600', '')
                    .trim();
                btn.classList.add(...'bg-white text-gray-600 border-gray-200 hover:border-emerald-300 hover:text-emerald-600'.split(' '));
            });

            const activeBtn = [...document.querySelectorAll('.period-btn')].find(b => b.getAttribute('onclick').includes("'" + value + "'"));
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-gray-600', 'border-gray-200', 'hover:border-emerald-300', 'hover:text-emerald-600');
                activeBtn.classList.add('bg-emerald-600', 'text-white', 'border-emerald-600');
            }

            // Show/hide custom date range
            const customSection = document.getElementById('custom-date-section');
            if (value === 'custom') {
                customSection.classList.remove('hidden');
                customSection.classList.add('flex');
            } else {
                customSection.classList.remove('flex');
                customSection.classList.add('hidden');
                // Auto-submit for non-custom periods
                document.getElementById('filter-form').submit();
            }
        }
    </script>
</x-app-layout>

