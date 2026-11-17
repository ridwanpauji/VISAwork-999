<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanKeuanganController extends Controller
{
    /**
     * Ambil query transaksi berdasarkan filter periode.
     */
    private function getFilteredQuery(Request $request)
    {
        $userId = Auth::id();
        $query  = Transaction::where('user_id', $userId);

        $period = $request->input('period', 'this_month');

        switch ($period) {
            case 'today':
                $query->whereDate('transaction_date', Carbon::today());
                break;
            case 'this_week':
                $query->whereBetween('transaction_date', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek(),
                ]);
                break;
            case 'this_month':
                $query->whereMonth('transaction_date', Carbon::now()->month)
                      ->whereYear('transaction_date', Carbon::now()->year);
                break;
            case 'last_month':
                $query->whereMonth('transaction_date', Carbon::now()->subMonth()->month)
                      ->whereYear('transaction_date', Carbon::now()->subMonth()->year);
                break;
            case 'this_year':
                $query->whereYear('transaction_date', Carbon::now()->year);
                break;
            case 'custom':
                if ($request->filled('date_from')) {
                    $query->whereDate('transaction_date', '>=', $request->date_from);
                }
                if ($request->filled('date_to')) {
                    $query->whereDate('transaction_date', '<=', $request->date_to);
                }
                break;
            default:
                // Semua data
                break;
        }

        return $query;
    }

    /**
     * Halaman utama laporan keuangan.
     */
    public function index(Request $request)
    {
        $query        = $this->getFilteredQuery($request);
        $transactions = $query->orderBy('transaction_date', 'desc')
                              ->orderBy('id', 'desc')
                              ->get();

        $totalIncome  = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $totalSaldo   = $totalIncome - $totalExpense;

        $period   = $request->input('period', 'this_month');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        return view('laporan-keuangan.index', compact(
            'transactions',
            'totalIncome',
            'totalExpense',
            'totalSaldo',
            'period',
            'dateFrom',
            'dateTo'
        ));
    }

    /**
     * Download laporan dalam format PDF.
     */
    public function downloadPdf(Request $request)
    {
        $query        = $this->getFilteredQuery($request);
        $transactions = $query->orderBy('transaction_date', 'asc')->get();

        $totalIncome  = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $totalSaldo   = $totalIncome - $totalExpense;

        $period   = $request->input('period', 'this_month');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');
        $userName = Auth::user()->name;
        $printDate = Carbon::now()->translatedFormat('d F Y');

        $periodeLabel = $this->getPeriodeLabel($period, $dateFrom, $dateTo);

        $pdf = Pdf::loadView('laporan-keuangan.pdf', compact(
            'transactions',
            'totalIncome',
            'totalExpense',
            'totalSaldo',
            'periodeLabel',
            'userName',
            'printDate'
        ))->setPaper('a4', 'portrait');

        $filename = 'Laporan_Keuangan_' . Carbon::now()->format('Ymd_His') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Download laporan dalam format Excel.
     */
    public function downloadExcel(Request $request)
    {
        $query        = $this->getFilteredQuery($request);
        $transactions = $query->orderBy('transaction_date', 'asc')->get();

        $totalIncome  = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $totalSaldo   = $totalIncome - $totalExpense;

        $period   = $request->input('period', 'this_month');
        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');
        $userName = Auth::user()->name;

        $periodeLabel = $this->getPeriodeLabel($period, $dateFrom, $dateTo);

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Keuangan');

        // ========== HEADER SECTION ==========
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'LAPORAN KEUANGAN - VISAwork');
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '065F46']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A2', 'Periode: ' . $periodeLabel);
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['size' => 11, 'color' => ['rgb' => '374151']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $sheet->mergeCells('A3:F3');
        $sheet->setCellValue('A3', 'Dicetak oleh: ' . $userName . ' | ' . Carbon::now()->translatedFormat('d F Y H:i'));
        $sheet->getStyle('A3')->applyFromArray([
            'font'      => ['size' => 9, 'color' => ['rgb' => '6B7280'], 'italic' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        // ========== RINGKASAN KEUANGAN ==========
        $sheet->mergeCells('A5:B5');
        $sheet->setCellValue('A5', 'RINGKASAN KEUANGAN');
        $sheet->getStyle('A5')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '065F46']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D1FAE5']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);

        $summaryData = [
            ['A6', 'B6', 'Total Pemasukan', $totalIncome, '10B981'],
            ['A7', 'B7', 'Total Pengeluaran', $totalExpense, 'F97316'],
            ['A8', 'B8', 'Saldo Bersih', $totalSaldo, $totalSaldo >= 0 ? '065F46' : 'DC2626'],
        ];

        foreach ($summaryData as [$labelCell, $valueCell, $label, $value, $color]) {
            $sheet->setCellValue($labelCell, $label);
            $sheet->setCellValue($valueCell, $value);
            $sheet->getStyle($labelCell)->applyFromArray([
                'font'      => ['bold' => true, 'color' => ['rgb' => '374151']],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9FAFB']],
            ]);
            $sheet->getStyle($valueCell)->applyFromArray([
                'font'           => ['bold' => true, 'color' => ['rgb' => $color]],
                'numberFormat'   => ['formatCode' => '"Rp "#,##0'],
                'alignment'      => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
                'fill'           => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9FAFB']],
            ]);
        }

        // ========== TABEL TRANSAKSI ==========
        $headerRow = 10;
        $headers   = ['No', 'Tanggal', 'Deskripsi / Keterangan', 'Kategori', 'Tipe', 'Nominal (Rp)'];
        $cols      = ['A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($headers as $i => $header) {
            $cell = $cols[$i] . $headerRow;
            $sheet->setCellValue($cell, $header);
        }

        $sheet->getStyle("A{$headerRow}:F{$headerRow}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 10],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '059669']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'borders'   => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D1FAE5']],
            ],
        ]);

        $row = $headerRow + 1;
        $no  = 1;

        foreach ($transactions as $trx) {
            $isIncome = $trx->type === 'income';
            $bgColor  = $row % 2 === 0 ? 'F9FAFB' : 'FFFFFF';

            $sheet->setCellValue("A{$row}", $no);
            $sheet->setCellValue("B{$row}", $trx->transaction_date ? Carbon::parse($trx->transaction_date)->format('d/m/Y') : '-');
            $sheet->setCellValue("C{$row}", $trx->description);
            $sheet->setCellValue("D{$row}", $trx->category);
            $sheet->setCellValue("E{$row}", $isIncome ? 'Pemasukan' : 'Pengeluaran');
            $sheet->setCellValue("F{$row}", (float) $trx->amount);

            $sheet->getStyle("A{$row}:F{$row}")->applyFromArray([
                'fill'    => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $bgColor]],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'E5E7EB']],
                ],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);

            $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("E{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle("E{$row}")->getFont()
                  ->getColor()->setRGB($isIncome ? '059669' : 'F97316');
            $sheet->getStyle("E{$row}")->getFont()->setBold(true);

            $sheet->getStyle("F{$row}")->applyFromArray([
                'numberFormat' => ['formatCode' => '#,##0'],
                'alignment'    => ['horizontal' => Alignment::HORIZONTAL_RIGHT],
                'font'         => ['color' => ['rgb' => $isIncome ? '059669' : '374151']],
            ]);

            $row++;
            $no++;
        }

        // Baris TOTAL
        $totalRow = $row;
        $sheet->mergeCells("A{$totalRow}:E{$totalRow}");
        $sheet->setCellValue("A{$totalRow}", 'TOTAL PEMASUKAN');
        $sheet->setCellValue("F{$totalRow}", (float) $totalIncome);
        $sheet->getStyle("A{$totalRow}:F{$totalRow}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => '059669']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D1FAE5']],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'A7F3D0']]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'numberFormat' => ['formatCode' => '#,##0'],
        ]);
        $sheet->getStyle("F{$totalRow}")->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("F{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $totalRow2 = $row + 1;
        $sheet->mergeCells("A{$totalRow2}:E{$totalRow2}");
        $sheet->setCellValue("A{$totalRow2}", 'TOTAL PENGELUARAN');
        $sheet->setCellValue("F{$totalRow2}", (float) $totalExpense);
        $sheet->getStyle("A{$totalRow2}:F{$totalRow2}")->applyFromArray([
            'font'      => ['bold' => true, 'color' => ['rgb' => 'F97316']],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FEF3C7']],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'FDE68A']]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("F{$totalRow2}")->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("F{$totalRow2}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $totalRow3 = $row + 2;
        $sheet->mergeCells("A{$totalRow3}:E{$totalRow3}");
        $sheet->setCellValue("A{$totalRow3}", 'SALDO BERSIH');
        $sheet->setCellValue("F{$totalRow3}", (float) $totalSaldo);
        $saldoColor = $totalSaldo >= 0 ? '065F46' : 'DC2626';
        $saldoBg    = $totalSaldo >= 0 ? 'ECFDF5' : 'FEF2F2';
        $sheet->getStyle("A{$totalRow3}:F{$totalRow3}")->applyFromArray([
            'font'      => ['bold' => true, 'size' => 11, 'color' => ['rgb' => $saldoColor]],
            'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $saldoBg]],
            'borders'   => ['allBorders' => ['borderStyle' => Border::BORDER_MEDIUM, 'color' => ['rgb' => 'D1FAE5']]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle("F{$totalRow3}")->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle("F{$totalRow3}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        // ========== SET LEBAR KOLOM ==========
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(14);
        $sheet->getColumnDimension('C')->setWidth(40);
        $sheet->getColumnDimension('D')->setWidth(18);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(20);

        $sheet->getRowDimension(1)->setRowHeight(24);
        $sheet->getRowDimension($headerRow)->setRowHeight(20);

        // ========== OUTPUT ==========
        $filename = 'Laporan_Keuangan_' . Carbon::now()->format('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    /**
     * Helper: label periode.
     */
    private function getPeriodeLabel(string $period, ?string $dateFrom, ?string $dateTo): string
    {
        return match ($period) {
            'today'      => 'Hari Ini (' . Carbon::today()->translatedFormat('d F Y') . ')',
            'this_week'  => 'Minggu Ini (' . Carbon::now()->startOfWeek()->translatedFormat('d M') . ' – ' . Carbon::now()->endOfWeek()->translatedFormat('d M Y') . ')',
            'this_month' => 'Bulan Ini (' . Carbon::now()->translatedFormat('F Y') . ')',
            'last_month' => 'Bulan Lalu (' . Carbon::now()->subMonth()->translatedFormat('F Y') . ')',
            'this_year'  => 'Tahun Ini (' . Carbon::now()->year . ')',
            'all'        => 'Semua Data',
            'custom'     => 'Custom: ' . ($dateFrom ? Carbon::parse($dateFrom)->translatedFormat('d M Y') : '...') . ' s/d ' . ($dateTo ? Carbon::parse($dateTo)->translatedFormat('d M Y') : '...'),
            default      => 'Semua Data',
        };
    }
}

