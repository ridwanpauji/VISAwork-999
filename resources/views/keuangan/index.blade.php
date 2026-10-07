<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | VISAwork</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-sm text-gray-600 min-h-screen flex">
    
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">VISAwork</h2>
        </div>
        <nav class="p-4 flex-grow space-y-1">
            <a href="/keuangan" class="block px-4 py-2 bg-gray-50 text-gray-800 font-medium rounded border border-gray-100">Dashboard</a>
            <a href="#" onclick="alert('Fitur ini segera hadir!')" class="block px-4 py-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded transition">Transaksi</a>
            <a href="#" onclick="alert('Fitur ini segera hadir!')" class="block px-4 py-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded transition">Laporan</a>
            <a href="#" onclick="alert('Fitur ini segera hadir!')" class="block px-4 py-2 text-gray-500 hover:bg-gray-50 hover:text-gray-700 rounded transition">Pengaturan</a>
        </nav>
    </aside>

    <div class="flex-grow flex flex-col min-w-0">
        <div class="flex-grow p-6 md:p-10">
            <div class="max-w-5xl mx-auto">
                
                <div class="flex justify-between items-end mb-8 border-b border-gray-200 pb-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
                        <p class="text-xs text-gray-400 mt-1">Ringkasan finansial VISAwork.</p>
                    </div>
                    <span class="px-3 py-1 bg-gray-100 border border-gray-200 rounded-full text-xs text-gray-500 font-medium">
                        Tahap Pengembangan
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white p-5 border border-gray-200 rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 mb-1">Total Saldo</p>
                        <h2 class="text-xl font-semibold text-gray-800">Rp 0</h2>
                    </div>
                    <div class="bg-white p-5 border border-gray-200 rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 mb-1">Pemasukan Bulan Ini</p>
                        <h2 class="text-xl font-medium text-gray-800">Rp 0</h2>
                    </div>
                    <div class="bg-white p-5 border border-gray-200 rounded-lg shadow-sm">
                        <p class="text-xs text-gray-500 mb-1">Pengeluaran Bulan Ini</p>
                        <h2 class="text-xl font-medium text-gray-800">Rp 0</h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-medium text-gray-800">Riwayat Transaksi</h3>
                            <button onclick="alert('Fitur ini segera hadir!')" class="text-xs border border-gray-200 px-3 py-1 rounded hover:bg-gray-50 transition">
                                Tambah Baru
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="text-gray-400 border-b border-gray-100">
                                    <tr>
                                        <th class="pb-3 font-medium">Tanggal</th>
                                        <th class="pb-3 font-medium">Keterangan</th>
                                        <th class="pb-3 font-medium">Jenis</th>
                                        <th class="pb-3 font-medium text-right">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-gray-400 border-b border-dashed border-gray-100">
                                            Belum ada data transaksi.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-gray-50 border border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center text-center">
                        <svg class="w-8 h-8 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <h3 class="font-medium text-gray-700 text-sm">Grafik Analisis</h3>
                        <p class="text-xs text-gray-500 mt-2 mb-4">Fitur visualisasi arus kas sedang dalam tahap pengembangan.</p>
                        <span class="bg-gray-200 text-gray-600 text-xs px-3 py-1 rounded-full font-medium">Coming Soon</span>
                    </div>

                </div>
                
            </div>
        </div>

        <footer class="py-4 text-center text-xs text-gray-400 border-t border-gray-200 bg-white mt-auto">
            <p>VISAwork v{{ env('APP_VERSION', '0.1.0') }} &copy; 2026</p>
        </footer>
    </div>
</body>
</html>