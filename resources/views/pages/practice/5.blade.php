@extends('layouts.dashboard')
@section('content')

    <!-- Laporan Stok Barang -->
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Laporan Stok Barang</h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama
                                    Produk</th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Kategori</th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Masuk
                                </th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Keluar</th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Sisa
                                </th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Stok
                                    Minimum</th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($laporan as $product)
                                @php
                                    $barangMasuk = $product->barang_masuk ?? 0;
                                    $barangKeluar = $product->barang_keluar ?? 0;
                                    $minimumStock = $product->minimum_stock ?? 0;
                                    $sisaStok = $barangMasuk - $barangKeluar;

                                    if ($sisaStok <= 0) {
                                        $status = 'Habis';
                                        $statusColor = 'text-red-500';
                                    } elseif ($sisaStok <= $minimumStock + 10) {
                                        $status = 'Hampir Habis';
                                        $statusColor = 'text-yellow-500';
                                    } else {
                                        $status = 'Tersedia';
                                        $statusColor = 'text-green-500';
                                    }
                                @endphp
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->name }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->category_id ?? '-' }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->barang_masuk }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $product->barang_keluar ?? '-' }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $sisaStok }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->minimum_stock }}</td>
                                    <td class="p-4 text-sm font-semibold {{ $statusColor }}">{{ $status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Laporan Transaksi Barang -->
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Laporan Transaksi Barang</h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Nama Produk</th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Tipe</th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Tanggal</th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($riwayatTransaksi as $product)
                                <tr>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->name }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->tipe }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->tanggal }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Aktivitas -->
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Riwayat Aktivitas</h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">User
                                </th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Aksi
                                </th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Waktu
                                </th>
                                <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($riwayatUser as $aktivitas)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $aktivitas->user->name ?? '-' }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ ucfirst($aktivitas->action) }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $aktivitas->created_at }}</td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $aktivitas->notes ?? "Tipe: $aktivitas->target_type, ID: $aktivitas->target_id" }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection