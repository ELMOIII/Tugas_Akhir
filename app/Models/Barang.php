<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori; // ✅ WAJIB TAMBAH INI

class Barang extends Model
{
    protected $fillable = [
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'stok_minimum',
        'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}