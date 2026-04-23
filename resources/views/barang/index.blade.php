@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Data Barang Galatama</h2>

{{-- 🔥 NOTIFIKASI STOK MINIMUM --}}
@if($warning->count())
<script>
Swal.fire({
    icon: 'warning',
    title: 'Stok Menipis!',
    html: `
        @foreach($warning as $w)
            {{ $w->nama_barang }} ({{ $w->stok }})<br>
        @endforeach
    `
});
</script>
@endif

{{-- ✅ NOTIFIKASI SUCCESS --}}
@if(session('success'))
<div class="bg-green-200 p-3 mb-3 rounded">
    {{ session('success') }}
</div>
@endif

{{-- 🔵 BUTTON TAMBAH --}}
<a href="/barang/create"
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
   + Tambah Barang
</a>

{{-- 🔍 FILTER --}}
<form method="GET" action="/barang" class="mb-4 flex items-center gap-3">

    <select name="kategori_id"
        class="w-48 border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500">

        <option value="">Semua Kategori</option>

        @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id }}"
                {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach

    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Filter
    </button>

    <a href="/barang"
       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        Reset
    </a>

</form>

{{-- 🔥 TABLE --}}
<div class="overflow-x-auto">
<table class="w-full border border-gray-200">

    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">No</th>
            <th class="p-3">Nama Barang</th>
            <th class="p-3">Kategori</th>
            <th class="p-2">Harga Beli</th>
            <th class="p-2">Harga Jual</th>
            <th class="p-3">Stok</th>
            <th class="p-3">Stok Minimum</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($barangs as $barang)

        <tr class="border-t hover:bg-gray-100 text-center">

            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $barang->nama_barang }}</td>
            <td class="p-3">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
            <td class="p-2">Rp {{ number_format($barang->harga_beli) }}</td>
            <td class="p-2">Rp {{ number_format($barang->harga_jual) }}</td>
            <td class="p-3">{{ $barang->stok }}</td>
            <td class="p-3">{{ $barang->stok_minimum }}</td>

            {{-- 🔥 AKSI --}}
            <td class="p-3 flex justify-center gap-2">

                {{-- EDIT --}}
                <a href="/barang/{{ $barang->id }}/edit"
                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                   Edit
                </a>

                {{-- HAPUS --}}
                <form action="/barang/{{ $barang->id }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        onclick="return confirm('Yakin mau hapus?')"
                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                        Hapus
                    </button>
                </form>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="8" class="text-center p-4">
                Data belum ada
            </td>
        </tr>

        @endforelse

    </tbody>

</table>
</div>

@endsection