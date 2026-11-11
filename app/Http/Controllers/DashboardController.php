<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $range = $request->get('range', '7days');

        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        $activeBalance = $totalIncome - $totalExpense;

        $now = now();
        $thisMonthIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->sum('amount');

        $thisMonthExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereYear('transaction_date', $now->year)
            ->whereMonth('transaction_date', $now->month)
            ->sum('amount');

        $recentTransactions = Transaction::where('user_id', $userId)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $chartDates = [];
        $chartIncome = [];
        $chartExpense = [];

        if ($range === '30days') {
            for ($i = 29; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $chartDates[] = now()->subDays($i)->format('d M');

                $chartIncome[] = (float) Transaction::where('user_id', $userId)
                    ->where('type', 'income')
                    ->whereDate('transaction_date', $date)
                    ->sum('amount');

                $chartExpense[] = (float) Transaction::where('user_id', $userId)
                    ->where('type', 'expense')
                    ->whereDate('transaction_date', $date)
                    ->sum('amount');
            }
        } elseif ($range === 'this_year') {
            for ($m = 1; $m <= 12; $m++) {
                $monthDate = now()->startOfYear()->addMonths($m - 1);
                $chartDates[] = $monthDate->translatedFormat('M');

                $chartIncome[] = (float) Transaction::where('user_id', $userId)
                    ->where('type', 'income')
                    ->whereYear('transaction_date', now()->year)
                    ->whereMonth('transaction_date', $m)
                    ->sum('amount');

                $chartExpense[] = (float) Transaction::where('user_id', $userId)
                    ->where('type', 'expense')
                    ->whereYear('transaction_date', now()->year)
                    ->whereMonth('transaction_date', $m)
                    ->sum('amount');
            }
        } else {
            // Default 7 days
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $chartDates[] = now()->subDays($i)->format('d M');

                $chartIncome[] = (float) Transaction::where('user_id', $userId)
                    ->where('type', 'income')
                    ->whereDate('transaction_date', $date)
                    ->sum('amount');

                $chartExpense[] = (float) Transaction::where('user_id', $userId)
                    ->where('type', 'expense')
                    ->whereDate('transaction_date', $date)
                    ->sum('amount');
            }
        }

        $hasChartData = (array_sum($chartIncome) > 0 || array_sum($chartExpense) > 0);

        return view('dashboard', compact(
            'activeBalance',
            'thisMonthIncome',
            'thisMonthExpense',
            'recentTransactions',
            'chartDates',
            'chartIncome',
            'chartExpense',
            'hasChartData',
            'range'
        ));
    }
}
