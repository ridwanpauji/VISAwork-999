<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Seed transactions jika kosong
            if (Transaction::where('user_id', $user->id)->count() === 0) {
                // Transaksi beberapa hari terakhir agar grafik dinamis & estetik
                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'income',
                    'amount' => 3500000,
                    'description' => 'Pembayaran Proyek Pembuatan Aplikasi',
                    'category' => 'Penjualan / Jasa',
                    'transaction_date' => now()->subDays(4)->toDateString(),
                ]);

                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'expense',
                    'amount' => 450000,
                    'description' => 'Langganan Cloud Server & Database',
                    'category' => 'Operasional',
                    'transaction_date' => now()->subDays(3)->toDateString(),
                ]);

                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'income',
                    'amount' => 2000000,
                    'description' => 'Retainer Bulanan Client B',
                    'category' => 'Penjualan / Jasa',
                    'transaction_date' => now()->subDays(1)->toDateString(),
                ]);

                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'expense',
                    'amount' => 300000,
                    'description' => 'Bahan Baku & Logistik Kantor',
                    'category' => 'Operasional',
                    'transaction_date' => now()->toDateString(),
                ]);

                Transaction::create([
                    'user_id' => $user->id,
                    'type' => 'income',
                    'amount' => 1250000,
                    'description' => 'Penjualan Lisensi Software Addon',
                    'category' => 'Penjualan / Jasa',
                    'transaction_date' => now()->toDateString(),
                ]);
            }

            // Seed produk jika kosong
            if (Product::where('user_id', $user->id)->count() === 0) {
                Product::create([
                    'user_id' => $user->id,
                    'sku' => 'PRD-001',
                    'name' => 'Monitor IPS 24 Inch Enterprise',
                    'category' => 'Elektronik / Hardware',
                    'price' => 2100000,
                    'stock' => 8,
                ]);

                Product::create([
                    'user_id' => $user->id,
                    'sku' => 'PRD-002',
                    'name' => 'Mechanical Keyboard Pro',
                    'category' => 'Peralatan Kantor',
                    'price' => 750000,
                    'stock' => 3,
                ]);

                Product::create([
                    'user_id' => $user->id,
                    'sku' => 'PRD-003',
                    'name' => 'Lisensi VISAwork Enterprise 1 Tahun',
                    'category' => 'Lisensi Software',
                    'price' => 1500000,
                    'stock' => 25,
                ]);
            }
        }
    }
}
