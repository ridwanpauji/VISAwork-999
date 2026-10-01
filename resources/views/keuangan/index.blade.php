<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | VISAwork</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    
    <!-- Bagian Konten Utama -->
    <div class="flex-grow p-8">
        <div class="max-w-4xl mx-auto">
            
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Keuangan BY FIKRI KNTL</h1>
                <!-- Tombol Navigasi Sementara -->
                <a href="/" class="text-sm bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Kembali ke Homepage</a>
            </div>

            <!-- Kartu Saldo -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8 border-l-4 border-blue-500">
                <h2 class="text-lg text-gray-600 font-semibold">Total Saldo Saat Ini  -- GK BISA DITAMBAH DATA, MASIH TAHAP PENGEMBANGAN KONTL</h2>
                <p class="text-4xl font-bold text-green-600 mt-2">Rp 5.000.000</p>
            </div>

            <!-- Tabel Riwayat Transaksi -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <div class="p-4 bg-gray-50 border-b flex justify-between items-center">
                    <h3 class="font-semibold text-gray-700">Riwayat Transaksi Terbaru</h3>
                    <button class="bg-green-500 text-white px-3 py-1 text-sm rounded hover:bg-green-600">+ Tambah Data</button>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="p-4 text-gray-600">Tanggal</th>
                            <th class="p-4 text-gray-600">Keterangan</th>
                            <th class="p-4 text-gray-600">Jenis</th>
                            <th class="p-4 text-gray-600">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">01 Okt 2026</td>
                            <td class="p-4">Beli Kopi & Camilan</td>
                            <td class="p-4 font-semibold text-red-500">Pengeluaran</td>
                            <td class="p-4 font-bold text-red-500">- Rp 35.000</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">30 Sep 2026</td>
                            <td class="p-4">Gajian Project Freelance</td>
                            <td class="p-4 font-semibold text-green-500">Pemasukan</td>
                            <td class="p-4 font-bold text-green-500">+ Rp 1.500.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bagian Footer & Versi Aplikasi -->
    <footer class="bg-white py-4 shadow-inner mt-auto">
        <div class="max-w-4xl mx-auto text-center text-sm text-gray-500">
            <p><strong>VISAwork</strong> v{{ env('APP_VERSION', '0.1.0') }} &copy; 2026 - Dikembangkan oleh Kelompok VISAWork</p>
        </div>
    </footer>

</body>
</html>