@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">📦 Laporan Stok Saat Ini</h2>
        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 
                font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
            Export PDF
        </button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Kode Barang</th>
                    <th scope="col" class="px-6 py-3">Nama Barang</th>
                    <th scope="col" class="px-6 py-3">Stok Saat Ini</th>
                    <th scope="col" class="px-6 py-3">Satuan</th>
                    <th scope="col" class="px-6 py-3">Terakhir Diupdate</th>
                </tr>
            </thead>
            <tbody>
                {{-- Baris contoh, nanti tinggal looping pakai @foreach --}}
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">1</td>
                    <td class="px-6 py-4">BRG-001</td>
                    <td class="px-6 py-4">Pulpen Hitam</td>
                    <td class="px-6 py-4">150</td>
                    <td class="px-6 py-4">pcs</td>
                    <td class="px-6 py-4">07 Juli 2025</td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">2</td>
                    <td class="px-6 py-4">BRG-002</td>
                    <td class="px-6 py-4">Kertas A4</td>
                    <td class="px-6 py-4">90</td>
                    <td class="px-6 py-4">rim</td>
                    <td class="px-6 py-4">06 Juli 2025</td>
                </tr>
                {{-- ... Tambah lagi jika perlu --}}
            </tbody>
        </table>
    </div>
</div>
@endsection
