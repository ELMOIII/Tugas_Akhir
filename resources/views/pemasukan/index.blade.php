@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Pemasukan Lomba</h2>

@if(session('success'))
<div class="bg-green-200 p-3 mb-3 rounded">
    {{ session('success') }}
</div>
@endif

<a href="/pemasukan/create"
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
   + Tambah Pemasukan
</a>

<table class="w-full border">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">No</th>
            <th class="p-2">Tanggal</th>
            <th class="p-2">Sesi</th>
            <th class="p-2">Peserta</th>
            <th class="p-2">Tiket</th>
            <th class="p-2">Total</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $d)
        <tr class="text-center border-t">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->tanggal }}</td>
            <td>{{ $d->nama_lomba }}</td>
            <td>{{ $d->jumlah_peserta }}</td>
            <td>Rp {{ number_format($d->harga_tiket) }}</td>
            <td>Rp {{ number_format($d->total) }}</td>
            <td>
                <form action="/pemasukan/{{ $d->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 rounded">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection