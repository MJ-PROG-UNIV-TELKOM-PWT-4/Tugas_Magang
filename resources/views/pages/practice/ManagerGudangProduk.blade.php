@extends('layouts.dashboard')  
@section('content')  

@php  
    $products = Illuminate\Support\Facades\DB::table('products')->get();  
    $categories = Illuminate\Support\Facades\DB::table('categories')->get(); 
@endphp  

<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">  
    <div class="w-full mb-1">  
        <div class="mb-4">  
            <nav class="flex mb-5" aria-label="Breadcrumb">  
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">  
                </ol>  
            </nav>  
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manage Produk</h1>  
        </div>  

        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">  
            <div class="flex items-center mb-4 sm:mb-0">  
                <form class="sm:pr-3" action="#" method="GET">  
                    <label for="products-search" class="sr-only">Search</label>  
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">  
                        <input type="text" name="search" id="products-search" oninput="filterProducts()" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for products">  
                    </div>  
                </form>  
            </div>  
        </div>  
    </div>  
</div>  

<div class="flex flex-col">  
    <div class="overflow-x-auto">  
        <div class="inline-block min-w-full align-middle">  
            <div class="overflow-hidden shadow">  
                <table id="product-table" class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">  
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">No</th>
                        <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">ID Kategori</th>
                        <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">ID Supplier</th>
                        <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama Produk</th>
                        <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Attribut Produk</th>
                        <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Stok Minimum</th>
                    </tr>
                    </thead>
                    <tbody id="product-body" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($products as $index => $product)
                        <tr class="product-row hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $product->category_id }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $product->supplier_id }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $product->name }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $product->description }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $product->minimum_stock }}</td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  
            </div>  
        </div>  
    </div>  
</div>

<!-- Javascript Functions -->
<script>  

// Function untuk menyaring produk berdasarkan kata kunci pencarian
function filterProducts() {
    const searchInput = document.getElementById('products-search').value.toLowerCase();
    const productRows = document.querySelectorAll('.product-row');

    productRows.forEach(row => {
        const productName = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Mengambil nama produk
        const productAttributes = row.querySelector('td:nth-child(4)').textContent.toLowerCase(); // Mengambil atribut produk
        const productMinimumStock = row.querySelector('td:nth-child(5)').textContent.toLowerCase(); // Mengambil minimum stock

        // Menampilkan atau menyembunyikan baris berdasarkan pencarian
        if (productName.includes(searchInput) || productAttributes.includes(searchInput) || productMinimumStock.includes(searchInput)) {
            row.style.display = ''; // Menampilkan baris
        } else {
            row.style.display = 'none'; // Menyembunyikan baris
        }
    });
}
</script>

@endsection