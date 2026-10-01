<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISAwork - Pengelola Keuangan</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard VISAwork</h1>

        <!-- Kartu Saldo -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8 border-l-4 border-blue-500">
            <h2 class="text-lg text-gray-600 font-semibold">Total Saldo Saat Ini</h2>
            <p class="text-4xl font-bold text-green-600 mt-2">Rp 5.000.000 Testing Doang KNTL</p>
        </div>

        <!-- Tabel Riwayat Transaksi -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
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
</body>
</html>