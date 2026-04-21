<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }

    // 🔹 FORM TAMBAH
    public function create()
    {
        return view('kategori.create');
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    // 🔹 FORM EDIT
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    // 🔹 HAPUS DATA
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}