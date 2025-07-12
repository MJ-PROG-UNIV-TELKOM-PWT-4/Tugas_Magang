@extends('layouts.dashboard')

@section('content')

@php
    use Illuminate\Support\Facades\DB;

    $products = DB::table('products')->get();
    $transactions = DB::table('stock_transactions')->get()->groupBy('product_id');
@endphp

<!-- Header -->
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manage Stok</h1>
        </div>
    </div>
</div>

<!-- Tabel Manajemen Stok -->
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">No</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama Produk</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Barang Masuk</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Tanggal Masuk</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Status</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Barang Keluar</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Tanggal Keluar</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Sisa Stok</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->name }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->barang_masuk }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->tanggal_masuk }}</td>
                                @php
                                    $lastMasuk = ($transactions[$product->id] ?? collect([]))->where('type', 'masuk')->last();
                                @endphp
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $lastMasuk->status ?? $product->status }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->barang_keluar }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->tanggal_keluar }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->barang_masuk - $product->barang_keluar }}</td>
                                <td class="p-4">
                                    <button onclick="openStockUpdateDrawer({{ $product->id }})"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        Update
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Stok Minimum -->
<div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-1.5">
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manage Stok Minimum</h1>
</div>

<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">No</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama Produk</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Stok Minimum</th>
                            <th class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($products as $product)
                            <tr>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $loop->iteration }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->name }}</td>
                                <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $product->minimum_stock ?? '-' }}</td>
                                <td class="p-4">
                                    <button type="button" onclick="openMinimumStockDrawer({{ $product->id }}, '{{ addslashes($product->minimum_stock) }}')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                                    Update  
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Drawer Update Stok -->
<div id="drawer-update-stock-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">

    <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">
        Update Barang Keluar
    </h5>

    <button type="button" onclick="toggleStockDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>

    <form method="POST" id="stockForm" action="">
        @csrf
        <input type="hidden" name="product_id" id="product_id">
        <input type="hidden" name="barang_masuk" id="barang_masuk" value="{{ $product->barang_masuk }}">
        <input type="hidden" name="product_id" id="product_id">

        <div class="space-y-4">
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" onchange="toggleKeluarForm()">
                    <option value="Pending">Pending</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Ditolak">Ditolak</option>
                    <option value="Dikeluarkan">Dikeluarkan</option>
                </select>
            </div>

            <div id="keluar-fields" class="hidden">
                <div>
                    <label for="barang_keluar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barang Keluar</label>
                    <input type="number" name="quantity" id="barang_keluar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan jumlah barang keluar" required>
                </div>

                <div>
                    <label for="tanggal_keluar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Keluar</label>
                    <input type="date" name="date" id="tanggal_keluar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">
            <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Update Stock
            </button>
            <button type="button" onclick="toggleStockDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Cancel
            </button>
        </div>
    </form>
</div>

<div id="stockOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleStockDrawer()"></div>

<!-- Drawer untuk Update Stok Minimum -->
<div id="drawer-update-minimum-stock" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">
    <h5 class="inline-flex items-center mb-4 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">Update Stok Minimum</h5>
    <button type="button" onclick="toggleMinimumStockDrawer()"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form method="POST" id="minimumStockForm" action="">
        @csrf
        @method('POST')
        <input type="hidden" name="product_id" id="minimum_product_id">
        <div class="space-y-4">
            <div>
                <label for="minimum_stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Minimum</label>
                <input type="number" name="minimum_stock" id="minimum_stock"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="Masukkan stok minimum" required>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">
            <button type="submit"
                class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Update Minimum Stock
            </button>
            <button type="button" onclick="toggleMinimumStockDrawer()"
                class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Cancel
            </button>
        </div>
    </form>
</div>
<div id="minimumStockOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleMinimumStockDrawer()"></div>

<script>
    function openStockUpdateDrawer(productId) {
        document.getElementById('stockForm').action = `/stock/update/${productId}`; // Atur action form
        document.getElementById('product_id').value = productId;
        toggleKeluarForm(); // Init toggle visibility
        document.getElementById('drawer-update-stock-default').classList.remove('translate-x-full');
        document.getElementById('stockOverlay').classList.remove('hidden');
    }

    function toggleStockDrawer() {
        document.getElementById('drawer-update-stock-default').classList.add('translate-x-full');
        document.getElementById('stockOverlay').classList.add('hidden');
    }

    function toggleKeluarForm() {
        const statusSelect = document.getElementById('status');
        const keluarFields = document.getElementById('keluar-fields');
        const barangKeluarInput = document.getElementById('barang_keluar');
        const tanggalKeluarInput = document.getElementById('tanggal_keluar');

        // Jika status "Dikeluarkan", tampilkan field terkait dan set required
        if (statusSelect.value === 'Dikeluarkan') {
            keluarFields.classList.remove('hidden');
            barangKeluarInput.setAttribute('required', 'required');
            tanggalKeluarInput.setAttribute('required', 'required');
        } else if (statusSelect.value === 'Ditolak') {
            // Set barang_masuk menjadi 0 jika status "Ditolak"
            document.getElementById('barang_masuk').value = 0; // Pastikan untuk menambahkan field ini ke formulir
        } else {
            // Ketika status bukan "Dikeluarkan" atau "Ditolak"
            keluarFields.classList.add('hidden');
            
            // Menghapus 'required' pada input tetapi tidak menghapus valuenya
            barangKeluarInput.removeAttribute('required');
            tanggalKeluarInput.removeAttribute('required');
        }
    }

    // Tambahkan event listener untuk inisialisasi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function () {
        toggleKeluarForm(); // Mengatur visibilitas saat halaman dimuat
        document.getElementById('status').addEventListener('change', toggleKeluarForm); // Mendengarkan perubahan status
    });

    function openMinimumStockDrawer(productId, minimumStock) {
        document.getElementById('minimumStockForm').action = `/minimum-stock/update/${productId}`; // Sesuaikan route
        document.getElementById('minimum_product_id').value = productId;
        document.getElementById('minimum_stock').value = minimumStock; // Mengisi nilai stok minimum dari database

        document.getElementById('drawer-update-minimum-stock').classList.remove('translate-x-full');
        document.getElementById('minimumStockOverlay').classList.remove('hidden');
    }

    function toggleMinimumStockDrawer() {
        document.getElementById('drawer-update-minimum-stock').classList.add('translate-x-full');
        document.getElementById('minimumStockOverlay').classList.add('hidden');
    }
</script>

@endsection