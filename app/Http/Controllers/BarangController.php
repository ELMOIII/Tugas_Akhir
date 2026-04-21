<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
public function index(Request $request)
{
    $kategoris = \App\Models\Kategori::all();

    $query = Barang::query();

    // 🔍 FILTER KATEGORI
    if ($request->kategori_id) {
        $query->where('kategori_id', $request->kategori_id);
    }

    $barangs = $query->get();

    return view('barang.index', compact('barangs', 'kategoris'));
}

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('barang.create', compact('kategoris'));
    }

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

    public function edit(Barang $barang)
    {
        $kategoris = \App\Models\Kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

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

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect('/barang')->with('success', 'Data berhasil dihapus');
    }
}