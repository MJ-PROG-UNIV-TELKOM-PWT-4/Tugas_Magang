@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">🔁 Transaksi Stok Barang</h1>
        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
            + Tambah Transaksi
        </a>
    </div>

    {{-- Tabel Transaksi Stok --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300 border-collapse">
            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Produk</th>
                    <th class="px-6 py-3">Tipe Transaksi</th>
                    <th class="px-6 py-3">Jumlah</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Catatan</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh Transaksi Masuk --}}
                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">2025-07-07</td>
                    <td class="px-6 py-4">Kabel USB</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded">Masuk</span>
                    </td>
                    <td class="px-6 py-4">100</td>
                    <td class="px-6 py-4">Admin Gudang</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Sukses</span>
                    </td>
                    <td class="px-6 py-4">Stok baru dari supplier</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-600 hover:underline">Edit</a> |
                        <a href="#" class="text-red-600 hover:underline">Hapus</a>
                    </td>
                </tr>

                {{-- Contoh Transaksi Keluar --}}
                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">2025-07-08</td>
                    <td class="px-6 py-4">Kertas A4</td>
                    <td class="px-6 py-4">
                        <span class="bg-red-100 text-red-700 text-xs font-medium px-2 py-1 rounded">Keluar</span>
                    </td>
                    <td class="px-6 py-4">50</td>
                    <td class="px-6 py-4">Staff Produksi</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Sukses</span>
                    </td>
                    <td class="px-6 py-4">Dipakai untuk produksi</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-600 hover:underline">Edit</a> |
                        <a href="#" class="text-red-600 hover:underline">Hapus</a>
                    </td>
                </tr>

                {{-- Contoh Stock Opname --}}
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">2025-07-09</td>
                    <td class="px-6 py-4">Baterai AA</td>
                    <td class="px-6 py-4">
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded">Stock Opname</span>
                    </td>
                    <td class="px-6 py-4">180</td>
                    <td class="px-6 py-4">Supervisor</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Valid</span>
                    </td>
                    <td class="px-6 py-4">Penyesuaian stok fisik</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-600 hover:underline">Edit</a> |
                        <a href="#" class="text-red-600 hover:underline">Hapus</a>
                    </td>
                </tr>
            <a/tbody>
        </table>
    </div>
</div>
@endsection