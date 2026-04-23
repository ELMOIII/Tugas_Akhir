@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Laporan Laba Rugi</h2>

<form method="GET" class="flex gap-2 mb-4">
    <input type="date" name="tanggal_awal" class="border p-2 rounded">
    <input type="date" name="tanggal_akhir" class="border p-2 rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Filter
    </button>
</form>

<div class="bg-white p-6 rounded shadow w-full max-w-lg">

    <div class="flex justify-between mb-2">
        <span>Total Pendapatan</span>
        <span>Rp {{ number_format($totalPendapatan) }}</span>
    </div>

    <div class="flex justify-between mb-2">
        <span>Total Pengeluaran</span>
        <span>Rp {{ number_format($totalPengeluaran) }}</span>
    </div>

    <hr class="my-3">

    <div class="flex justify-between font-bold text-lg">
        <span>Laba / Rugi</span>
        <span class="{{ $laba >= 0 ? 'text-green-600' : 'text-red-600' }}">
            Rp {{ number_format($laba) }}
        </span>
    </div>

</div>

@endsection