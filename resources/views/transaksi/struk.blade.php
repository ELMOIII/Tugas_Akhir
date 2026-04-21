<!DOCTYPE html>
<html>
<head>
    <title>Struk Transaksi</title>

    <!-- 🔥 SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: monospace;
            width: 300px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        .line {
            border-top: 1px dashed black;
            margin: 10px 0;
        }
        .flex {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

<!-- 🔥 ALERT SUKSES -->
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

<h2>Galatama TMB</h2>

<p>Tanggal: {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y') }}</p>
<p>Jam: {{ \Carbon\Carbon::parse($transaksi->created_at)->format('H:i:s') }}</p>
<p>Kasir: {{ $transaksi->user->name ?? '-' }}</p>
<p>No Transaksi: #{{ $transaksi->id }}</p>

<div class="line"></div>

@foreach($transaksi->details as $d)
    <div>
        <strong>{{ $d->barang->nama_barang }}</strong>
        <div class="flex">
            <span>{{ $d->jumlah }} x {{ number_format($d->barang->harga_jual) }}</span>
            <span>{{ number_format($d->subtotal) }}</span>
        </div>
    </div>
@endforeach

<div class="line"></div>

<div class="flex">
    <strong>Total</strong>
    <strong>Rp {{ number_format($transaksi->total) }}</strong>
</div>

<div class="flex">
    <span>Bayar</span>
    <span>Rp {{ number_format($transaksi->bayar) }}</span>
</div>

<div class="flex">
    <span>Kembalian</span>
    <span>Rp {{ number_format($transaksi->kembalian) }}</span>
</div>

<div class="flex">
    <span>Pembayaran</span>
    <span>{{ ucfirst($transaksi->metode_pembayaran) }}</span>
</div>

<div class="line"></div>

<p style="text-align:center;">Terima Kasih 🙏</p>

<br>

<button onclick="window.print()">🖨️ Print</button>
<a href="/transaksi">⬅ Kembali</a>

</body>
</html>