<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function labaRugi(Request $request)
    {
        $queryMasuk = DetailTransaksi::query();
        $queryKeluar = Pengeluaran::query();

        // 🔍 filter tanggal
        if ($request->tanggal_awal && $request->tanggal_akhir) {

            $queryMasuk->whereHas('transaksi', function ($q) use ($request) {
                $q->whereBetween('tanggal', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            });

            $queryKeluar->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        // 💰 ambil data
        $pendapatan = $queryMasuk->sum('keuntungan'); // 🔥 REAL PROFIT
        $pengeluaran = $queryKeluar->sum('jumlah');

        $laba = $pendapatan - $pengeluaran;

        return view('laporan.laba-rugi', compact(
            'pendapatan',
            'pengeluaran',
            'laba'
        ));
    }

    public function grafik()
{
    $data = \App\Models\Transaksi::selectRaw('DATE(tanggal) as tanggal, SUM(total) as total')
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();

    $labels = $data->pluck('tanggal');
    $totals = $data->pluck('total');

    return view('laporan.grafik', compact('labels', 'totals'));
}
}