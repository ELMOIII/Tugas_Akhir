@extends('layout.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Edit Pengeluaran</h2>

<form method="POST" action="/pengeluaran/{{ $pengeluaran->id }}">
@csrf
@method('PUT')

<input type="date" name="tanggal" value="{{ $pengeluaran->tanggal }}" class="border p-2 w-full mb-2">

<input type="text" name="kategori" value="{{ $pengeluaran->kategori }}" class="border p-2 w-full mb-2">

<input type="text" name="keterangan" value="{{ $pengeluaran->keterangan }}" class="border p-2 w-full mb-2">

<input type="number" name="jumlah" value="{{ $pengeluaran->jumlah }}" class="border p-2 w-full mb-2">

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Update
</button>

</form>

@endsection