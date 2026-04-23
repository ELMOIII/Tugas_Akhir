@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Data Pengeluaran</h2>

<a href="/pengeluaran/create"
   class="bg-green-600 text-white px-4 py-2 rounded">
   + Tambah
</a>

@if(session('success'))
<div class="bg-green-200 p-2 mt-3 rounded">
    {{ session('success') }}
</div>
@endif

<table class="w-full mt-4 border">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Tanggal</th>
            <th class="p-2">Kategori</th>
            <th class="p-2">Keterangan</th>
            <th class="p-2">Jumlah</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($pengeluarans as $p)
        <tr class="text-center border-t">
            <td class="p-2">{{ $p->tanggal }}</td>
            <td class="p-2">{{ $p->kategori }}</td>
            <td class="p-2">{{ $p->keterangan }}</td>
            <td class="p-2">Rp {{ number_format($p->jumlah) }}</td>
            <td class="p-2">
                <a href="/pengeluaran/{{ $p->id }}/edit"
                   class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>

                <form action="/pengeluaran/{{ $p->id }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 rounded">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection