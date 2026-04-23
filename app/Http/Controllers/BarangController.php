<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // =========================
    // 📌 LIST + FILTER + WARNING
    // =========================
    public function index(Request $request)
    {
        $kategoris = Kategori::all();

        $query = Barang::query();

        // 🔍 FILTER KATEGORI
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $barangs = $query->get();

        // 🔔 NOTIFIKASI STOK MINIMUM
        $warning = $barangs->filter(function ($item) {
            return $item->stok <= $item->stok_minimum;
        });

        return view('barang.index', compact('barangs', 'kategoris', 'warning'));
    }

    // =========================
    // 📌 FORM CREATE
    // =========================
    public function create()
    {
        $kategoris = Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    // =========================
    // 📌 STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'stok_minimum' => 'required|numeric',
        ]);

        Barang::create($request->only([
            'nama_barang',
            'kategori_id',
            'harga_beli',
            'harga_jual',
            'stok',
            'stok_minimum'
        ]));

        return redirect('/barang')->with('success', 'Data berhasil ditambahkan');
    }

    // =========================
    // 📌 EDIT
    // =========================
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    // =========================
    // 📌 UPDATE
    // =========================
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
            'stok_minimum' => 'required|numeric',
        ]);

        $barang->update($request->only([
            'nama_barang',
            'kategori_id',
            'harga_beli',
            'harga_jual',
            'stok',
            'stok_minimum'
        ]));

        return redirect('/barang')->with('success', 'Data berhasil diupdate');
    }

    // =========================
    // 📌 DELETE
    // =========================
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect('/barang')->with('success', 'Data berhasil dihapus');
    }
}