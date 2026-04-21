@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Tambah Barang</h2>

{{-- ERROR VALIDASI --}}
@if ($errors->any())
<div class="bg-red-200 p-3 mb-3 rounded">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form action="/barang" method="POST" class="space-y-4">
    @csrf

    <input type="text" name="nama_barang"
        value="{{ old('nama_barang') }}"
        placeholder="Nama Barang"
        class="w-full border p-2 rounded">

    <select name="kategori_id" class="w-full border p-2 rounded">
    <option value="">Pilih Kategori</option>
        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}">
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>

    <input type="number" name="harga_beli"
        value="{{ old('harga_beli') }}"
        placeholder="Harga Beli"
        class="w-full border p-2 rounded">

    <input type="number" name="harga_jual"
        value="{{ old('harga_jual') }}"
        placeholder="Harga Jual"
        class="w-full border p-2 rounded">

    <input type="number" name="stok"
        value="{{ old('stok') }}"
        placeholder="Stok"
        class="w-full border p-2 rounded">

    <input type="number" name="stok_minimum"
        value="{{ old('stok_minimum') }}"
        placeholder="Stok Minimum"
        class="w-full border p-2 rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>

</form>

@endsection