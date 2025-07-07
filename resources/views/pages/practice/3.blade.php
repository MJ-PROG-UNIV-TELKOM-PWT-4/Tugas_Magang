@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">🏢 Daftar Supplier</h1>
        <a href="#" class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-lg">
            + Tambah Supplier
        </a>
    </div>

    {{-- Tabel Supplier --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-300 border-collapse">
            <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">Nama Supplier</th>
                    <th class="px-6 py-3">Kontak</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh baris --}}
                <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">PT. Kertas Nusantara</td>
                    <td class="px-6 py-4">0812-3456-7890</td>
                    <td class="px-6 py-4">Jl. Mawar No. 7, Jakarta</td>
                    <td class="px-6 py-4">supplier@kertas.co.id</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-600 hover:underline text-sm">Edit</a> |
                        <a href="#" class="text-red-600 hover:underline text-sm ms-2">Hapus</a>
                    </td>
                </tr>
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">CV. Sumber Elektronik</td>
                    <td class="px-6 py-4">0821-7777-8888</td>
                    <td class="px-6 py-4">Jl. Listrik No. 88, Bandung</td>
                    <td class="px-6 py-4">cs@sumberelektronik.co.id</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-blue-600 hover:underline text-sm">Edit</a> |
                        <a href="#" class="text-red-600 hover:underline text-sm ms-2">Hapus</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection