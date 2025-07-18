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
        $produkStokHabis = 0; // Inisialisasi counter untuk produk tidak tersedia

        foreach ($products as $product) {
            $sisaStok = $product->barang_masuk - $product->barang_keluar; // Menghitung sisa stok
            $stockData[$product->name] = $sisaStok; // Menyimpan nama produk dan sisa stok
            
            // Menghitung produk yang sisa stoknya 0 atau kurang
            if ($sisaStok <= 0) {
                $produkStokHabis++;
            }
        }

        // Data untuk grafik
        $chartLabels = array_keys($stockData);
        $chartData = array_values($stockData);

        // Alternatif query untuk menghitung produk stok habis (jika diperlukan)
        // $produkStokHabisQuery = DB::table('products')
        //     ->whereRaw('barang_masuk - barang_keluar <= 0')
        //     ->count();

        $kategoriTerbanyak = DB::table('products')
            ->select('categories.name', DB::raw('COUNT(*) as jumlah'))
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->orderByDesc('jumlah')
            ->first();

        $supplierTop = DB::table('products')
            ->select('suppliers.name', DB::raw('COUNT(*) as jumlah'))
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->groupBy('suppliers.name')
            ->orderByDesc('jumlah')
            ->first();

        $produkTertinggi = collect($stockData)->sortDesc()->keys()->first();

    @endphp

    <!-- Header -->
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Dashboard</h1>
    </div>

    <!-- Cards Ringkasan -->
    <div class="my-4">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            <!-- Card Produk -->
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <span class="text-2xl">📦</span>
                    <div class="ml-4">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate dark:text-gray-400">Jumlah Produk</dt>
                            <dd class="text-lg font-medium text-gray-900 dark:text-white">{{ $totalProducts }}</dd>
                        </dl>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ $produkStokHabis }} produk tidak tersedia
                        </p>
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
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Kategori Terbanyak: {{ $kategoriTerbanyak->name ?? '-' }}
                        </p>
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
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Supplier Aktif: {{ $supplierTop->name ?? '-' }}
                        </p>
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
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Produk dengan stok tertinggi: {{ $produkTertinggi }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Sisa Stok Barang -->
        <div class="mt-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white px-4 py-2">Grafik Stok Produk</h3>
            <div class="relative h-80 p-4">
                <canvas id="stockChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    <!-- Riwayat Aktivitas Pengguna Hari Ini -->
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-4 flex items-center justify-between border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Riwayat Aktivitas Hari Ini</h2>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                        User</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                        Aksi</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                        Waktu</th>
                                    <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                        Detail</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @forelse($aktivitasHariIni as $aktivitas)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $aktivitas->user->name ?? '-' }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ ucfirst($aktivitas->action) }}
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($aktivitas->created_at)->format('H:i') }}
                                            ({{ \Carbon\Carbon::parse($aktivitas->created_at)->diffForHumans() }})
                                        </td>
                                        <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $aktivitas->notes ?? "Tipe: $aktivitas->target_type, ID: $aktivitas->target_id" }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Belum ada aktivitas hari ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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