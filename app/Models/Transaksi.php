<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;
use App\Models\User;

class Transaksi extends Model
{
    protected $fillable = [
        'tanggal',
        'total',
        'metode_pembayaran',
        'bayar',
        'kembalian',
        'user_id'
    ];

    // 🔥 RELASI KE DETAIL
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    // 🔥 RELASI KE USER (KASIR)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}