<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // =========================
    // 📌 HALAMAN TRANSAKSI (POS)
    // =========================
    public function index()
    {
        $barangs = Barang::all();
        return view('transaksi.index', compact('barangs'));
    }

    // =========================
    // 📌 STRUK TRANSAKSI
    // =========================
    public function show($id)
    {
        $transaksi = Transaksi::with('details.barang', 'user')->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }

    // =========================
    // 📌 LAPORAN
    // =========================
    public function laporan(Request $request)
    {
        $query = Transaksi::query();

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        $transaksis = $query->latest()->get();
        $total = $transaksis->sum('total');

        return view('transaksi.laporan', compact('transaksis', 'total'));
    }

    // =========================
    // 📌 SIMPAN TRANSAKSI (FINAL FIX)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'barang_id.*' => 'required|exists:barangs,id',
            'jumlah.*' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required',
            'bayar' => 'required|numeric|min:1'
        ]);

        DB::beginTransaction();

        try {
            $total = 0;

            // 🔥 LOOP ITEM DULU (tanpa create transaksi)
            $items = [];

            foreach ($request->barang_id as $key => $barang_id) {

                // skip kalau kosong
                if (!$barang_id) continue;

                $barang = Barang::findOrFail($barang_id);
                $jumlah = $request->jumlah[$key];

                // cek stok
                if ($barang->stok < $jumlah) {
                    DB::rollBack();
                    return back()->with('error', 'Stok tidak cukup untuk ' . $barang->nama_barang);
                }

                $subtotal = $barang->harga_jual * $jumlah;

                $items[] = [
                    'barang' => $barang,
                    'barang_id' => $barang_id,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal
                ];

                $total += $subtotal;
            }

            // 🔥 VALIDASI BAYAR
            if ($request->bayar < $total) {
                DB::rollBack();
                return back()->with('error', 'Uang tidak cukup!');
            }

            // 🔥 BUAT TRANSAKSI
            $transaksi = Transaksi::create([
                'tanggal' => now(),
                'total' => $total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total,
                'user_id' => auth()->id()
            ]);

            // 🔥 SIMPAN DETAIL + KURANGI STOK
            foreach ($items as $item) {

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal']
                ]);

                $item['barang']->stok -= $item['jumlah'];
                $item['barang']->save();
            }

            DB::commit();

            return redirect('/transaksi/' . $transaksi->id)
                ->with('success', 'Transaksi berhasil');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}