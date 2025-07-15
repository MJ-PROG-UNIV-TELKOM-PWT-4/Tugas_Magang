@extends('layouts.dashboard')  
@section('content')  

@php  
    $products = Illuminate\Support\Facades\DB::table('products')->get();  
    $categories = Illuminate\Support\Facades\DB::table('categories')->get(); 
@endphp  

<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">  
    <div class="w-full mb-1">  
        <div class="mb-4">  
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
            <button id="createProductButton" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button" onclick="toggleProductDrawer('create')">  
                Tambahkan Produk Baru  
            </button>  
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
                        <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Actions</th>
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
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button type="button" 
                                        onclick="openUpdateProductDrawer({{ $product->id }}, '{{ $product->name }}', {{ $product->category_id }}, {{ $product->supplier_id }}, '{{ addslashes($product->description) }}', {{ $product->minimum_stock }})"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Update
                                </button> 
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to delete this product?')"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  
            </div>  
        </div>  
    </div>  
</div>

<!-- Manage Kategori Section -->
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">  
    <div class="w-full mb-1">  
        <div class="mb-4">  
            <nav class="flex mb-5" aria-label="Breadcrumb">  
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">  
                </ol>  
            </nav>  
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manage Kategori</h1>  
        </div>  

        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">  
            <div class="flex items-center mb-4 sm:mb-0">  
                <form class="sm:pr-3" action="#" method="GET">  
                    <label for="categories-search" class="sr-only">Search</label>  
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">  
                        <input type="text" name="search" id="categories-search" oninput="filterCategories()" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for categories">  
                    </div>  
                </form>  
            </div>  
            <button id="createCategoryButton" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button" onclick="toggleCategoryDrawer('create')">  
                Tambahkan Kategori Baru  
            </button>  
        </div>  
    </div>  
</div>  

<div class="flex flex-col">  
    <div class="overflow-x-auto">  
        <div class="inline-block min-w-full align-middle">  
            <div class="overflow-hidden shadow">  
                <table id="category-table" class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">  
                    <thead class="bg-gray-100 dark:bg-gray-700">  
                        <tr>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">No</th>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama Kategori</th>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Deskripsi Kategori</th>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Actions</th>  
                        </tr>  
                    </thead>  
                    <tbody id="category-body" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">  
                        @foreach($categories as $index => $category)
                        <tr class="category-row hover:bg-gray-100 dark:hover:bg-gray-700">  
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $category->name }}</td>  
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $category->description }}</td>  
                            <td class="p-4 space-x-2 whitespace-nowrap">  
                                <button type="button"  
                                        onclick="openCategoryUpdateDrawer({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description) }}')"  
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                                    Update  
                                </button>  
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">  
                                    @csrf  
                                    @method('DELETE')  
                                    <button type="submit"  
                                            onclick="return confirm('Are you sure you want to delete this category?')"  
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">  
                                        Delete  
                                    </button>  
                                </form>  
                            </td>  
                        </tr>  
                        @endforeach  
                    </tbody> 
                </table>  
            </div>  
        </div>  
    </div>  
</div>

<!-- Overlay untuk menutup drawer produk -->  
<div id="product-drawer-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleProductDrawer()"></div>  
<!-- Drawer untuk Tambah Produk -->  
<div id="drawer-create-product-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">  
    <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">New Product</h5>  
    <button type="button" onclick="toggleProductDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">  
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">  
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>  
        </svg>  
        <span class="sr-only">Close menu</span>  
    </button>  
<form action="{{ route('products.store') }}" method="POST">  
    @csrf  
    <input type="hidden" name="status" value="Pending">
    <div class="space-y-4">  
        <div>  
            <label for="create-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>  
            <input type="text" name="name" id="create-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required>  
        </div>  
        <div>  
            <label for="create-category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kategori</label>  
            <input type="number" name="category_id" id="create-category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Category ID" required>  
        </div>  
        <div>  
            <label for="create-supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Supplier</label>  
            <input type="number" name="supplier_id" id="create-supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Supplier ID" required>  
        </div>  
        <div>  
            <label for="create-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attribut Produk</label>  
            <textarea id="create-description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan atribut produk seperti merek, model, ukuran, warna, berat bersih, dan tanggal kadaluarsa"></textarea>  
        </div>
        <div>  
            <label for="create-barang_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barang Masuk</label>  
            <input type="number" name="barang_masuk" id="create-barang_masuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Jumlah barang masuk" required>  
        </div>  
        <div>  
            <label for="create-tanggal_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Masuk</label>  
            <input type="date" name="tanggal_masuk" id="create-tanggal_masuk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>  
        </div>  
    </div>  
        
        <!-- Button Section -->
        <div class="flex justify-center p-4 space-x-4">  
            <button type="submit" class="text-white w-1/2 justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                Add Product  
            </button>  
            <button type="button" onclick="toggleProductDrawer()" class="inline-flex w-1/2 justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">  
                Cancel  
            </button>  
        </div>
    </form>  
</div>

<!-- Overlay untuk menutup drawer kategori -->  
<div id="category-drawer-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleCategoryDrawer()"></div>  
<!-- Drawer untuk Tambah Kategori -->  
<div id="drawer-create-category-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">  
    <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">New Category</h5>  
    <button type="button" onclick="toggleCategoryDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">  
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">  
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>  
        </svg>  
        <span class="sr-only">Close menu</span>  
    </button>  
    <form action="{{ route('categories.store') }}" method="POST">  
        @csrf  
        <div class="space-y-4">  
            <div>  
                <label for="create-category-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>  
                <input type="text" name="name" id="create-category-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type category name" required>  
            </div>  
            <div>  
                <label for="create-category-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Kategori</label>  
                <textarea id="create-category-description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter category description here"></textarea>  
            </div>  
        </div>  
        <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">  
            <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                Add Category  
            </button>  
            <button type="button" onclick="toggleCategoryDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">  
                Cancel  
            </button>  
        </div>  
    </form>  
</div>

<!-- Drawer untuk Update Produk -->
<div id="drawer-update-product-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">
    <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">Update Product</h5>
    <button type="button" onclick="toggleProductDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form id="update-product-form" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="update-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                <input type="text" name="name" id="update-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type product name" required>
            </div>
            <div>
                <label for="update-category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Kategori</label>
                <input type="number" name="category_id" id="update-category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Category ID" required>
            </div>
            <div>
                <label for="update-supplier_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Supplier</label>
                <input type="number" name="supplier_id" id="update-supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Supplier ID" required>
            </div>
            <div>
                <label for="update-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attribut Produk</label>
                <textarea id="update-description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter product attributes"></textarea>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">
            <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Update Product
            </button>
            <button type="button" onclick="toggleProductDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Cancel
            </button>
        </div>
    </form>
</div>

<!-- Drawer untuk Update Kategori -->
<div id="drawer-update-category-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">
    <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">Update Category</h5>
    <button type="button" onclick="toggleCategoryDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form id="update-category-form" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="update-category-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
                <input type="text" name="name" id="update-category-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type category name" required>
            </div>
            <div>
                <label for="update-category-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Kategori</label>
                <textarea id="update-category-description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter category description"></textarea>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">
            <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Update Category
            </button>
            <button type="button" onclick="toggleCategoryDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                Cancel
            </button>
        </div>
    </form>
</div>

<!-- Overlay untuk update produk -->
<div id="product-update-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleProductDrawer()"></div>

<!-- Overlay untuk update kategori -->
<div id="category-update-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleCategoryDrawer()"></div>

<!-- Javascript Functions -->
<script>  
let currentProductDrawerType = null;  
let currentCategoryDrawerType = null; 

// Function to toggle product drawer
function toggleProductDrawer(type = null) {  
    const createDrawer = document.getElementById('drawer-create-product-default');  
    const updateDrawer = document.getElementById('drawer-update-product-default');  
    const createOverlay = document.getElementById('product-drawer-overlay');
    const updateOverlay = document.getElementById('product-update-overlay');
    
    // Close any current drawer
    if (currentProductDrawerType) {  
        const currentDrawer = currentProductDrawerType === 'create' ? createDrawer : updateDrawer;
        const currentOverlay = currentProductDrawerType === 'create' ? createOverlay : updateOverlay;
        
        currentDrawer.classList.remove('translate-x-0');  
        currentDrawer.classList.add('translate-x-full');  
        currentOverlay.classList.add('hidden');  
        currentProductDrawerType = null;  
    }  
    
    // Open the drawer if the type is provided  
    if (type) {  
        const targetDrawer = type === 'create' ? createDrawer : updateDrawer;
        const targetOverlay = type === 'create' ? createOverlay : updateOverlay;
        
        targetDrawer.classList.remove('translate-x-full');  
        targetDrawer.classList.add('translate-x-0');  
        targetOverlay.classList.remove('hidden');  
        currentProductDrawerType = type;  
    }  
}

// Update the toggle function for category drawer similarly
function toggleCategoryDrawer(type = null) {  
    const createDrawer = document.getElementById('drawer-create-category-default');  
    const updateDrawer = document.getElementById('drawer-update-category-default');  
    const createOverlay = document.getElementById('category-drawer-overlay');
    const updateOverlay = document.getElementById('category-update-overlay');
    
    // Close any current drawer
    if (currentCategoryDrawerType) {  
        const currentDrawer = currentCategoryDrawerType === 'create' ? createDrawer : updateDrawer;
        const currentOverlay = currentCategoryDrawerType === 'create' ? createOverlay : updateOverlay;
        
        currentDrawer.classList.remove('translate-x-0');  
        currentDrawer.classList.add('translate-x-full');  
        currentOverlay.classList.add('hidden');  
        currentCategoryDrawerType = null;  
    }  
    
    // Open the drawer if the type is provided  
    if (type) {  
        const targetDrawer = type === 'create' ? createDrawer : updateDrawer;
        const targetOverlay = type === 'create' ? createOverlay : updateOverlay;
        
        targetDrawer.classList.remove('translate-x-full');  
        targetDrawer.classList.add('translate-x-0');  
        targetOverlay.classList.remove('hidden');  
        currentCategoryDrawerType = type;  
    }  
}

// Fungsi untuk membuka drawer update produk
function openUpdateProductDrawer(id, name, category_id, supplier_id, description) {
    // Set action form update
    const form = document.getElementById('update-product-form');
    form.action = `/products/${id}`; // Pastikan route ini sesuai

    // Isi nilai field update
    document.getElementById('update-name').value = name;
    document.getElementById('update-category_id').value = category_id;
    document.getElementById('update-supplier_id').value = supplier_id;
    document.getElementById('update-description').value = description;

    // Buka drawer update
    toggleProductDrawer('update');
}

// Fungsi untuk membuka drawer update kategori
function openCategoryUpdateDrawer(id, name, description) {
    // Set action form update
    const form = document.getElementById('update-category-form');
    form.action = `/categories/${id}`; // Pastikan route ini sesuai

    // Isi nilai field update
    document.getElementById('update-category-name').value = name;
    document.getElementById('update-category-description').value = description;

    // Buka drawer update
    toggleCategoryDrawer('update');
}


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

// Function untuk menyaring kategori berdasarkan kata kunci pencarian
function filterCategories() {
    const searchInput = document.getElementById('categories-search').value.toLowerCase();
    const categoryRows = document.querySelectorAll('.category-row');

    categoryRows.forEach(row => {
        const categoryName = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Mengambil nama kategori
        const categoryDescription = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Mengambil deskripsi kategori

        // Menampilkan atau menyembunyikan baris berdasarkan pencarian
        if (categoryName.includes(searchInput) || categoryDescription.includes(searchInput)) {
            row.style.display = ''; // Menampilkan baris
        } else {
            row.style.display = 'none'; // Menyembunyikan baris
        }
    });
}

// Close drawer with ESC key  
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        if (currentProductDrawerType) {
            toggleProductDrawer();
        }
        if (currentCategoryDrawerType) {
            toggleCategoryDrawer();
        }
    }
});

// Clear create form when opening the drawer
document.getElementById('createCategoryButton').addEventListener('click', function() {
    document.getElementById('create-category-name').value = '';
    document.getElementById('create-category-description').value = '';
});

document.getElementById('createProductButton').addEventListener('click', function() {
    document.getElementById('create-name').value = '';
    document.getElementById('create-category_id').value = '';
    document.getElementById('create-supplier_id').value = '';
    document.getElementById('create-description').value = '';
    document.getElementById('create-minimum_stock').value = '';
});
</script>

@endsection