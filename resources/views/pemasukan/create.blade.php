@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Tambah Pemasukan Lomba</h2>

<form action="/pemasukan" method="POST">
@csrf

<div class="mb-3">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="border p-2 w-full">
</div>

<div class="mb-3">
    <label>Nama Sesi</label>
    <input type="text" name="nama_lomba"
           placeholder="Sesi Pagi / Sesi Malam"
           class="border p-2 w-full">
</div>

<div class="mb-3">
    <label>Jumlah Peserta</label>
    <input type="number" name="jumlah_peserta" class="border p-2 w-full">
</div>

<div class="mb-3">
    <label>Harga Tiket</label>
    <input type="number" name="harga_tiket" class="border p-2 w-full">
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded">
    Simpan
</button>

</form>

@endsection