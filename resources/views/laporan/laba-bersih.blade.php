@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Laporan Laba Bersih</h2>

<form method="GET" class="flex gap-2 mb-4">
    <input type="date" name="tanggal_awal" class="border p-2 rounded">
    <input type="date" name="tanggal_akhir" class="border p-2 rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Filter
    </button>
</form>

<div class="bg-white p-5 rounded shadow w-1/2">

    <div class="flex justify-between mb-2">
        <span>Total Pendapatan</span>
        <span>Rp {{ number_format($pendapatan) }}</span>
    </div>

    <div class="flex justify-between mb-2">
        <span>Total Pengeluaran</span>
        <span>Rp {{ number_format($pengeluaran) }}</span>
    </div>

    <hr class="my-3">

    <div class="flex justify-between font-bold text-lg">
        <span>Laba / Bersih</span>
        <span class="{{ $laba >= 0 ? 'text-green-600' : 'text-red-600' }}">
            Rp {{ number_format($laba) }}
        </span>
    </div>

</div>

@endsection