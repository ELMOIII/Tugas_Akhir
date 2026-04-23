<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    // 📌 TAMPIL DATA
    public function index()
    {
        $data = Pemasukan::latest()->get();
        return view('pemasukan.index', compact('data'));
    }

    // 📌 FORM TAMBAH
    public function create()
    {
        return view('pemasukan.create');
    }

    // 📌 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'nama_lomba' => 'required',
            'jumlah_peserta' => 'required|numeric|min:1',
            'harga_tiket' => 'required|numeric|min:1',
        ]);

        $total = $request->jumlah_peserta * $request->harga_tiket;

        Pemasukan::create([
            'tanggal' => $request->tanggal,
            'nama_lomba' => $request->nama_lomba,
            'jumlah_peserta' => $request->jumlah_peserta,
            'harga_tiket' => $request->harga_tiket,
            'total' => $total,
        ]);

        return redirect('/pemasukan')->with('success', 'Pemasukan berhasil ditambahkan');
    }

    // 📌 HAPUS
    public function destroy($id)
    {
        Pemasukan::findOrFail($id)->delete();
        return back()->with('success', 'Data dihapus');
    }
}