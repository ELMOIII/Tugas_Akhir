@extends('layout.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Tambah Pengeluaran</h2>

<form method="POST" action="/pengeluaran">
@csrf

<input type="date" name="tanggal" class="border p-2 w-full mb-2">

<input type="text" name="kategori" placeholder="Kategori"
       class="border p-2 w-full mb-2">

<input type="text" name="keterangan" placeholder="Keterangan"
       class="border p-2 w-full mb-2">

<input type="number" name="jumlah" placeholder="Jumlah"
       class="border p-2 w-full mb-2">

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Simpan
</button>

</form>

@endsection