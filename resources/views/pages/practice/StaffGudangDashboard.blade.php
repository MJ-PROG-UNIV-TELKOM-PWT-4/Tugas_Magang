@extends('layouts.dashboard')
@section('content')
@php
    use Illuminate\Support\Facades\DB;
    $pendingMasuk = DB::table('products')
        ->where('status', 'Pending')
        ->whereNotNull('barang_masuk')
        ->get();
    $siapKeluar = DB::table('products')
        ->where('status', 'Dikeluarkan')
        ->whereNotNull('barang_keluar')
        ->get();
@endphp

<!-- Header -->
<div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 mb-6">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-6 mb-6">
    <div class="bg-yellow-50 dark:bg-gray-700 border border-yellow-200 dark:border-gray-600 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-400">Perlu Diperiksa</p>
                <p class="text-2xl font-bold text-yellow-900 dark:text-yellow-300">{{ $pendingMasuk->count() }}</p>
            </div>
            <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-500/20 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-green-50 dark:bg-gray-700 border border-green-200 dark:border-gray-600 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-green-800 dark:text-green-400">Siap Keluar</p>
                <p class="text-2xl font-bold text-green-900 dark:text-green-300">{{ $siapKeluar->count() }}</p>
            </div>
            <div class="w-8 h-8 bg-green-100 dark:bg-green-500/20 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Konten -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 px-6">
    <!-- Barang Masuk Pending -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Barang Masuk - Perlu Diperiksa</h2>
        </div>
        <div class="p-6">
            @if ($pendingMasuk->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada barang masuk yang menunggu</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($pendingMasuk as $item)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-600 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->barang_masuk ?? 'Tanggal tidak tersedia' }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-500/20 dark:text-yellow-400">
                                {{ $item->status }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Barang Keluar - Siap Disiapkan -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Barang Keluar - Siap Disiapkan</h2>
        </div>
        <div class="p-6">
            @if ($siapKeluar->isEmpty())
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4m16 0l-4 4m4-4l-4-4"></path>
                    </svg>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada permintaan barang keluar saat ini</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($siapKeluar as $item)
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-600 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->barang_keluar ?? 'Tanggal tidak tersedia' }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400">
                                {{ $item->status }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Tombol ke halaman stok -->
<div class="mt-8 px-6">
    <a href="{{ route('practice.eleventh') }}"
       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        Kelola Stok Gudang
    </a>
</div>
@endsection