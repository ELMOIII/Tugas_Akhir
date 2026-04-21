@extends('layout.app')

@section('content')

<!-- 🔥 SELECT2 CDN (WAJIB DI ATAS) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<h2 class="text-2xl font-bold mb-4">Transaksi</h2>

@if(session('success'))
<div class="bg-green-200 p-3 mb-3 rounded">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-200 p-3 mb-3 rounded">
    {{ session('error') }}
</div>
@endif

<form action="/transaksi" method="POST">
@csrf

<table class="w-full border" id="table-transaksi">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Barang</th>
            <th class="p-2">Harga</th>
            <th class="p-2">Jumlah</th>
            <th class="p-2">Subtotal</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td class="p-2">
                <select name="barang_id[]" class="barang select2">
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">
                            {{ $barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
            </td>

            <td class="p-2 harga text-center">0</td>

            <td class="p-2">
                <input type="number" name="jumlah[]" class="border p-2 w-full jumlah" min="1" value="1">
            </td>

            <td class="p-2 subtotal text-center">0</td>

            <td class="p-2 text-center">
                <button type="button" class="hapus bg-red-500 text-white px-2 rounded">X</button>
            </td>
        </tr>
    </tbody>
</table>

<button type="button" id="tambah"
    class="bg-green-600 text-white px-4 py-2 mt-3 rounded">
    + Tambah Baris
</button>

<h3 class="text-xl font-bold mt-4">
    Total: Rp <span id="total">0</span>
</h3>

<!-- 🔥 PEMBAYARAN -->
<div class="mt-4 space-y-2">

    <div>
        <label class="block mb-1">Metode Pembayaran</label>
        <select name="metode_pembayaran" class="border p-2 w-full rounded">
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="qris">QRIS</option>
        </select>
    </div>

    <div>
        <label class="block mb-1">Uang Bayar</label>
        <input type="number" name="bayar" id="bayar"
               class="border p-2 w-full rounded"
               placeholder="Masukkan uang bayar">
    </div>

    <div class="font-bold">
        Kembalian: Rp <span id="kembalian">0</span>
    </div>

</div>

<button type="submit"
    class="bg-blue-600 text-white px-4 py-2 mt-3 rounded">
    Simpan Transaksi
</button>

</form>

<!-- 🔥 JS CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- 🔥 SCRIPT UTAMA -->
<script>
$(document).ready(function () {

    // 🔥 INIT SELECT2
    function initSelect2() {
        $('.select2').select2({
            placeholder: "Cari barang...",
            width: '100%'
        });
    }

    initSelect2();

    // 🔥 HITUNG TOTAL
    function hitungTotal() {
        let total = 0;
        $(".subtotal").each(function () {
            total += parseInt($(this).text()) || 0;
        });
        $("#total").text(total);
    }

    // 🔥 SAAT PILIH BARANG (FIX SELECT2)
    $(document).on('change', '.barang', function () {
        let harga = $(this).find(':selected').data('harga') || 0;
        let row = $(this).closest('tr');

        row.find('.harga').text(harga);

        let jumlah = row.find('.jumlah').val();
        row.find('.subtotal').text(harga * jumlah);

        hitungTotal();

        // 🔥 fokus ke jumlah setelah pilih barang
        row.find('.jumlah').focus();
    });

    // 🔥 SAAT INPUT JUMLAH
    $(document).on('input', '.jumlah', function () {
        let row = $(this).closest('tr');

        let harga = parseInt(row.find('.harga').text()) || 0;
        let jumlah = parseInt($(this).val()) || 0;

        row.find('.subtotal').text(harga * jumlah);

        hitungTotal();
    });

    // 🔥 TAMBAH BARIS
    $("#tambah").click(function () {
        let row = $("#table-transaksi tbody tr:first").clone();

        row.find("input").val(1);
        row.find(".harga, .subtotal").text(0);
        row.find("select").val("");

        $("#table-transaksi tbody").append(row);

        initSelect2();
    });

    // 🔥 HAPUS BARIS
    $(document).on('click', '.hapus', function () {
        if ($("#table-transaksi tbody tr").length > 1) {
            $(this).closest('tr').remove();
            hitungTotal();
        }
    });

    // 🔥 HITUNG KEMBALIAN
    $("#bayar").on('input', function () {
        let bayar = parseInt($(this).val()) || 0;
        let total = parseInt($("#total").text()) || 0;

        let kembalian = bayar - total;
        $("#kembalian").text(kembalian > 0 ? kembalian : 0);
    });

});
</script>

@endsection