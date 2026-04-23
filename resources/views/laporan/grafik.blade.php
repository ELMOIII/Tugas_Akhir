@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Grafik Penjualan</h2>

<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Penjualan',
            data: @json($totals),
            borderWidth: 2
        }]
    }
});
</script>

@endsection