@extends('layouts.dashboard')

@section('content')

@php
    use Illuminate\Support\Facades\DB;

    $pendingMasuk = DB::table('products')
        ->where('status', 'Pending')
        ->whereNotNull('barang_masuk') // bisa disesuaikan
        ->get();

    $siapKeluar = DB::table('products')
        ->where('status', 'Dikeluarkan')
        ->whereNotNull('barang_keluar')
        ->get();
@endphp

<!-- Header -->
<div class="p-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 mb-4">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard Staff Gudang</h1>
    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Lihat aktivitas gudang terkini dan tugas harian Anda.</p>
</div>

<!-- Konten -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4">
    
    <!-- Barang Masuk Pending -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Barang Masuk - Perlu Diperiksa</h2>
        @if ($pendingMasuk->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada barang masuk yang menunggu.</p>
        @else
            <ul class="space-y-2">
                @foreach ($pendingMasuk as $item)
                    <li class="text-sm text-gray-700 dark:text-gray-300 flex justify-between">
                        <span>{{ $item->name }}</span>
                        <span class="text-xs text-yellow-600">Status: {{ $item->status }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Barang Keluar - Siap Disiapkan -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Barang Keluar - Siap Disiapkan</h2>
        @if ($siapKeluar->isEmpty())
            <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada permintaan barang keluar saat ini.</p>
        @else
            <ul class="space-y-2">
                @foreach ($siapKeluar as $item)
                    <li class="text-sm text-gray-700 dark:text-gray-300 flex justify-between">
                        <span>{{ $item->name }}</span>
                        <span class="text-xs text-green-600">Status: {{ $item->status }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<!-- Tombol ke halaman stok -->
<div class="mt-8 px-4">
    <a href="{{ route('practice.eleventh') }}"
       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
        Kelola Stok Gudang
    </a>
</div>

@endsection