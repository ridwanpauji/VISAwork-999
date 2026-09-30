<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        $user = DB::table('users')
            ->where('email', 'admin@visawork.com')
            ->first();

        // Metode pembayaran
        $paymentId = (string) Str::uuid();

        DB::table('payments')->insert([
            'id' => $paymentId,
            'user_id' => $user->id,
            'name' => 'Bank BCA',
            'type' => 'Bank',
            'account_number' => '1234567890',
            'account_owner' => 'Admin VISAwork',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pemasukan
        DB::table('incomes')->insert([
            'id' => (string) Str::uuid(),
            'user_id' => $user->id,
            'source_id' => (string) Str::uuid(),
            'date' => now()->toDateString(),
            'nominal' => 5000000,
            'notes' => 'Gaji Bulanan',
            'month' => now()->format('F'),
            'year' => now()->year,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Pengeluaran
        DB::table('expenses')->insert([
            'id' => (string) Str::uuid(),
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'description' => 'Kebutuhan Bulanan',
            'nominal' => 1500000,
            'type' => 'Kebutuhan',
            'type_detail_id' => (string) Str::uuid(),
            'payment_id' => $paymentId,
            'notes' => 'Pengeluaran bulanan',
            'month' => now()->format('F'),
            'year' => now()->year,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Anggaran
        DB::table('budgets')->insert([
            'id' => (string) Str::uuid(),
            'user_id' => $user->id,
            'detail' => 'Kebutuhan Bulanan',
            'nominal' => 2000000,
            'month' => now()->format('F'),
            'year' => now()->year,
            'type' => 'Kebutuhan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}