@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Edit Barang</h2>

@if ($errors->any())
<div class="bg-red-200 p-3 mb-3 rounded">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<form action="/barang/{{ $barang->id }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <!-- Nama -->
    <input type="text" name="nama_barang"
        value="{{ old('nama_barang', $barang->nama_barang) }}"
        class="w-full border p-2 rounded">

    <!-- 🔥 KATEGORI (WAJIB) -->
    <select name="kategori_id" class="w-full border p-2 rounded">
        <option value="">Pilih Kategori</option>
        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}"
                {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>

    <!-- Harga Beli -->
    <input type="number" name="harga_beli"
        value="{{ old('harga_beli', $barang->harga_beli) }}"
        class="w-full border p-2 rounded">

    <!-- Harga Jual -->
    <input type="number" name="harga_jual"
        value="{{ old('harga_jual', $barang->harga_jual) }}"
        class="w-full border p-2 rounded">

    <!-- Stok -->
    <input type="number" name="stok"
        value="{{ old('stok', $barang->stok) }}"
        class="w-full border p-2 rounded">

    <!-- Stok Minimum -->
    <input type="number" name="stok_minimum"
        value="{{ old('stok_minimum', $barang->stok_minimum) }}"
        class="w-full border p-2 rounded">

    <button class="bg-green-600 text-white px-4 py-2 rounded">
        Update
    </button>

</form>

@endsection