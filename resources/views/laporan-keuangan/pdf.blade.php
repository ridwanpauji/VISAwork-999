<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - VISAwork</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 11px;
            color: #374151;
            background: #fff;
        }

        /* ===== HEADER ===== */
        .header {
            background: linear-gradient(135deg, #065F46 0%, #059669 100%);
            color: white;
            padding: 24px 32px;
            margin-bottom: 24px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .brand-name span {
            font-weight: 300;
            opacity: 0.85;
        }

        .header-meta {
            text-align: right;
            font-size: 10px;
            opacity: 0.85;
            line-height: 1.6;
        }

        .report-title {
            margin-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.3);
            padding-top: 12px;
        }

        .report-title h1 {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .report-title p {
            font-size: 10px;
            opacity: 0.8;
            margin-top: 3px;
        }

        /* ===== RINGKASAN ===== */
        .summary-section {
            padding: 0 32px;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            color: #065F46;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            padding-bottom: 4px;
            border-bottom: 2px solid #D1FAE5;
        }

        .summary-cards {
            display: table;
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
        }

        .summary-card {
            display: table-cell;
            width: 33.33%;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 14px 16px;
            vertical-align: top;
        }

        .summary-card.income {
            border-left: 4px solid #059669;
        }

        .summary-card.expense {
            border-left: 4px solid #F97316;
        }

        .summary-card.saldo {
            border-left: 4px solid #3B82F6;
        }

        .summary-card.saldo-negative {
            border-left: 4px solid #EF4444;
        }

        .card-label {
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6B7280;
            margin-bottom: 6px;
        }

        .card-value {
            font-size: 14px;
            font-weight: 700;
        }

        .card-value.income { color: #059669; }
        .card-value.expense { color: #F97316; }
        .card-value.saldo-pos { color: #2563EB; }
        .card-value.saldo-neg { color: #EF4444; }

        /* ===== TABEL ===== */
        .table-section {
            padding: 0 32px;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background-color: #059669;
            color: white;
        }

        thead th {
            padding: 10px 12px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        thead th:last-child {
            text-align: right;
        }

        tbody tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        tbody tr:nth-child(odd) {
            background-color: #FFFFFF;
        }

        tbody td {
            padding: 9px 12px;
            font-size: 10px;
            border-bottom: 1px solid #F3F4F6;
            vertical-align: middle;
        }

        tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
        }

        .badge-income {
            background: #D1FAE5;
            color: #065F46;
        }

        .badge-expense {
            background: #FEF3C7;
            color: #92400E;
        }

        .amount-income {
            color: #059669;
        }

        .amount-expense {
            color: #374151;
        }

        /* ===== FOOTER TABEL ===== */
        tfoot tr.footer-income td {
            padding: 10px 12px;
            font-size: 10px;
            font-weight: 700;
            background: #ECFDF5;
            color: #065F46;
            border-top: 2px solid #A7F3D0;
        }

        tfoot tr.footer-expense td {
            padding: 10px 12px;
            font-size: 10px;
            font-weight: 700;
            background: #FFF7ED;
            color: #C2410C;
            border-top: 1px solid #FED7AA;
        }

        tfoot tr.footer-saldo td {
            padding: 12px 12px;
            font-size: 12px;
            font-weight: 700;
            border-top: 2px solid #D1D5DB;
        }

        tfoot .footer-saldo-pos td {
            background: #ECFDF5;
            color: #065F46;
        }

        tfoot .footer-saldo-neg td {
            background: #FEF2F2;
            color: #DC2626;
        }

        td.text-right, th.text-right {
            text-align: right;
        }

        td.text-center {
            text-align: center;
        }

        /* ===== DOCUMENT FOOTER ===== */
        .doc-footer {
            padding: 16px 32px;
            border-top: 1px solid #E5E7EB;
            font-size: 9px;
            color: #9CA3AF;
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
        }

        .no-data {
            text-align: center;
            padding: 40px 0;
            color: #9CA3AF;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <div class="header-top">
            <div>
                <div class="brand-name">VISA<span>work</span></div>
            </div>
            <div class="header-meta">
                <div>Dicetak oleh: {{ $userName }}</div>
                <div>Tanggal Cetak: {{ $printDate }}</div>
            </div>
        </div>
        <div class="report-title">
            <h1>LAPORAN KEUANGAN</h1>
            <p>Periode: {{ $periodeLabel }}</p>
        </div>
    </div>

    <!-- RINGKASAN KEUANGAN -->
    <div class="summary-section">
        <div class="section-title">Ringkasan Keuangan</div>
        <table class="summary-cards">
            <tr>
                <td class="summary-card income">
                    <div class="card-label">Total Pemasukan</div>
                    <div class="card-value income">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
                </td>
                <td class="summary-card expense">
                    <div class="card-label">Total Pengeluaran</div>
                    <div class="card-value expense">Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
                </td>
                <td class="summary-card {{ $totalSaldo >= 0 ? 'saldo' : 'saldo-negative' }}">
                    <div class="card-label">Saldo Bersih</div>
                    <div class="card-value {{ $totalSaldo >= 0 ? 'saldo-pos' : 'saldo-neg' }}">
                        {{ $totalSaldo >= 0 ? '' : '-' }}Rp {{ number_format(abs($totalSaldo), 0, ',', '.') }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- TABEL TRANSAKSI -->
    <div class="table-section">
        <div class="section-title">Detail Transaksi ({{ $transactions->count() }} transaksi)</div>
        @if($transactions->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width:5%">No</th>
                    <th style="width:12%">Tanggal</th>
                    <th style="width:35%">Deskripsi / Keterangan</th>
                    <th style="width:15%">Kategori</th>
                    <th style="width:11%; text-align:center">Tipe</th>
                    <th style="width:22%; text-align:right">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $index => $trx)
                <tr>
                    <td class="text-center" style="color:#9CA3AF">{{ $index + 1 }}</td>
                    <td style="color:#6B7280">{{ $trx->transaction_date ? \Carbon\Carbon::parse($trx->transaction_date)->format('d/m/Y') : '-' }}</td>
                    <td style="font-weight:600; color:#111827">{{ $trx->description }}</td>
                    <td>
                        <span style="background:#F3F4F6; color:#6B7280; padding:2px 7px; border-radius:4px; font-size:9px">
                            {{ $trx->category }}
                        </span>
                    </td>
                    <td class="text-center">
                        <span class="badge {{ $trx->type === 'income' ? 'badge-income' : 'badge-expense' }}">
                            {{ $trx->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                        </span>
                    </td>
                    <td class="{{ $trx->type === 'income' ? 'amount-income' : 'amount-expense' }}">
                        {{ $trx->type === 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="footer-income">
                    <td colspan="5" style="font-weight:700">Total Pemasukan</td>
                    <td class="text-right">+ Rp {{ number_format($totalIncome, 0, ',', '.') }}</td>
                </tr>
                <tr class="footer-expense">
                    <td colspan="5" style="font-weight:700">Total Pengeluaran</td>
                    <td class="text-right">- Rp {{ number_format($totalExpense, 0, ',', '.') }}</td>
                </tr>
                <tr class="{{ $totalSaldo >= 0 ? 'footer-saldo footer-saldo-pos' : 'footer-saldo footer-saldo-neg' }}">
                    <td colspan="5" style="font-weight:700; font-size:12px">Saldo Bersih</td>
                    <td class="text-right" style="font-size:12px">
                        {{ $totalSaldo >= 0 ? '' : '-' }}Rp {{ number_format(abs($totalSaldo), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
        @else
        <div class="no-data">
            <p>Tidak ada data transaksi untuk periode ini.</p>
        </div>
        @endif
    </div>

    <!-- FOOTER DOKUMEN -->
    <div class="doc-footer">
        <div>VISAwork &copy; {{ date('Y') }} &mdash; Dokumen ini digenerate secara otomatis oleh sistem.</div>
        <div>Periode: {{ $periodeLabel }}</div>
    </div>

</body>
</html>

