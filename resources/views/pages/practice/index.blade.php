@extends('layouts.dashboard')

@section('content')

@php
    use Illuminate\Support\Facades\DB;

    // Mengambil data dari database
    $totalProducts = DB::table('products')->count();
    $totalCategories = DB::table('categories')->count();
    $totalSuppliers = DB::table('suppliers')->count();

    // Mengambil semua produk untuk menghitung sisa stok
    $products = DB::table('products')->get();
    $stockData = [];

    foreach ($products as $product) {
        $sisaStok = $product->barang_masuk - $product->barang_keluar; // Menghitung sisa stok
        $stockData[$product->name] = $sisaStok; // Menyimpan nama produk dan sisa stok
    }

    // Mengambil aktivitas pengguna terbaru
    $recentActivities = DB::table('activity_logs')
        ->join('users', 'activity_logs.user_id', '=', 'users.id')
        ->select('activity_logs.*', 'users.name as user_name')
        ->orderBy('activity_logs.created_at', 'desc')
        ->limit(5)
        ->get();
    
    // Data untuk grafik
    $chartLabels = array_keys($stockData);
    $chartData = array_values($stockData);
@endphp

<!-- Header -->
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Dashboard</h1>
</div>

<!-- Cards Ringkasan -->
<div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
        <!-- Card Produk -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center">
                <span class="text-2xl">📦</span>
                <div class="ml-4">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Jumlah Produk</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalProducts }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card Kategori -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center">
                <span class="text-2xl">📂</span>
                <div class="ml-4">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Jumlah Kategori</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalCategories }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card Supplier -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center">
                <span class="text-2xl">🏢</span>
                <div class="ml-4">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Jumlah Supplier</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalSuppliers }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Card Total Stok -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center">
                <span class="text-2xl">📊</span>
                <div class="ml-4">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Total Stok</dt>
                        <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ array_sum($chartData) }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Sisa Stok Barang -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white px-4 py-2">Grafik Stok Produk</h3>
        <div class="relative h-80 p-4">
            <canvas id="stockChart" class="w-full h-full"></canvas>
        </div>
        
        <!-- Keterangan Stok Produk -->
        <div class="p-4">
            <h4 class="text-md font-semibold text-gray-900 dark:text-white">Keterangan Stok Produk:</h4>
            <ul class="list-disc pl-10">
                @foreach ($stockData as $productName => $sisaStok)
                    <li class="text-sm text-gray-700 dark:text-gray-300">{{ $productName }}: {{ $sisaStok }} stok tersedia</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<!-- Aktivitas Pengguna Terbaru -->
 

<!-- Chart.js Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    // Data untuk grafik
    const chartLabels = @json($chartLabels);
    const chartData = @json($chartData);

    // Konfigurasi grafik
    const ctx = document.getElementById('stockChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // Bisa diganti ke 'line' jika ingin line chart
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Stok Produk',
                data: chartData,
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Grafik Stok Produk Berdasarkan Nama Produk'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 100,
                    }
                }
            }
        }
    });
</script>

@endsection