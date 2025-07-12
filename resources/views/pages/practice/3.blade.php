@extends('layouts.dashboard')

@section('content')

    @php  
        $suppliers = Illuminate\Support\Facades\DB::table('suppliers')->get();  
    @endphp

    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manage Suppliers</h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <div class="flex items-center mb-4 sm:mb-0">
                    <form class="sm:pr-3" action="#" method="GET">
                        <label for="suppliers-search" class="sr-only">Search</label>
                        <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                            <input type="text" name="search" id="suppliers-search" oninput="filterSuppliers()"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Search for suppliers">
                        </div>
                    </form>
                </div>
                <button id="createSupplierButton"
                    class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                    type="button" onclick="toggleDrawer('create')">
                    Add New Supplier
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table id="supplier-table" class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">ID
                                    Supplier</th>
                                <th scope="col"
                                    class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama
                                    Supplier</th>
                                <th scope="col"
                                    class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Alamat</th>
                                <th scope="col"
                                    class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">No
                                    Telepon</th>
                                <th scope="col"
                                    class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Email
                                </th>
                                <th scope="col"
                                    class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody id="supplier-body"
                            class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($suppliers as $supplier)
                                <tr class="supplier-row hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $supplier->id }}</td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $supplier->name }}</td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $supplier->address }}</td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $supplier->phone }}</td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $supplier->email }}</td>
                                    <td class="p-4 space-x-2 whitespace-nowrap">
                                        <button type="button"
                                            onclick="openUpdateDrawer({{ $supplier->id }}, '{{ $supplier->name }}', '{{ addslashes($supplier->address) }}', '{{ $supplier->phone }}', '{{ $supplier->email }}' )"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            Update
                                        </button>
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this supplier?')"
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

    <!-- Overlay untuk menutup drawer -->
    <div id="drawer-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleDrawer()"></div>

    <!-- Drawer untuk Tambah Supplier -->
    <div id="drawer-create-supplier-default"
        class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800"
        tabindex="-1">
        <h5
            class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">
            New Supplier</h5>
        <button type="button" onclick="toggleDrawer()"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="create-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Supplier</label>
                    <input type="text" name="name" id="create-name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Masukan Nama Supplier" required>
                </div>
                <div>
                    <label for="create-address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <textarea name="address" id="create-address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Masukan Alamat Lengkap Supplier" required></textarea>
                </div>  
                 <div>  
                    <label for="create-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>  
                    <input type="Text" id="create-phone" name="phone" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan Nomor Telepon Supplier"></input>  
                </div>  
                <div>  
                    <label for="create-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>  
                    <input type="email" id="create-email" name="email" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan Email Supplier"></input>  
                </div>  
            </div>  
            <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">  
                <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                    Add Supplier  
                </button>  
                <button type="button" onclick="toggleDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">  
                    Cancel  
                </button>  
            </div>  
        </form>  
    </div>  

    <!-- Drawer untuk Update Supplier -->  
    <div id="drawer-update-supplier-default" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">  
        <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">Update Supplier</h5>  
        <button type="button" onclick="toggleDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">  
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">  
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>  
            </svg>  
            <span class="sr-only">Close menu</span>  
        </button>  
        <form id="update-supplier-form" action="" method="POST">  
            @csrf  
            @method('PUT')  
            <div class="space-y-4">  
                <div>  
                    <label for="update-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Supplier</label>  
                    <input type="text" name="name" id="update-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan Nama Supplier" required>  
                </div>  
                <div>  
                    <label for="update-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>  
                    <textarea name="address" id="update-address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan Alamat Lengkap Supplier" required></textarea>  
                </div>  
                <div>  
                    <label for="update-phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>  
                    <input type="text" name="phone" id="update-phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan Nomor Telepon Supplier" required>  
                </div>  
                <div>  
                    <label for="update-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>  
                    <input type="email" id="update-email" name="email" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukan Email Supplier"></input>  
                </div>  
            </div>  
            <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">  
                <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                    Update Supplier  
                </button>  
                <button type="button" onclick="toggleDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">  
                    Cancel  
                </button>  
            </div>  
        </form>  
    </div>  

    <script>  
        let currentDrawerType = null;

        function toggleDrawer(type = null) {
            const createDrawer = document.getElementById('drawer-create-supplier-default');
            const updateDrawer = document.getElementById('drawer-update-supplier-default');
            const overlay = document.getElementById('drawer-overlay');

            // Tutup semua drawer
            createDrawer.classList.add('translate-x-full');
            updateDrawer.classList.add('translate-x-full');
            overlay.classList.add('hidden');

            currentDrawerType = null;

            // Kalau buka drawer
            if (type === 'create') {
                createDrawer.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                currentDrawerType = 'create';
            } else if (type === 'update') {
                updateDrawer.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                currentDrawerType = 'update';
            }
        }

        function openUpdateDrawer(id, name, address, phone, email) {
            // Set form action URL  
            const form = document.getElementById('update-supplier-form');
            form.action = `/suppliers/${id}`;  // Pastikan URL sesuai dengan rute  
            form.querySelector('#update-name').value = name;
            form.querySelector('#update-address').value = address;
            form.querySelector('#update-phone').value = phone;
            form.querySelector('#update-email').value = email;

            toggleDrawer('update');
        }

        // Function untuk menyaring supplier berdasarkan kata kunci pencarian
        function filterSuppliers() {
            const searchInput = document.getElementById('suppliers-search').value.toLowerCase();
            const supplierRows = document.querySelectorAll('.supplier-row');

            supplierRows.forEach(row => {
                const supplierName = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Mengambil nama supplier
                // Menampilkan atau menyembunyikan baris berdasarkan pencarian
                if (supplierName.includes(searchInput)) {
                    row.style.display = ''; // Menampilkan baris
                } else {
                    row.style.display = 'none'; // Menyembunyikan baris
                }
            });
        };

        // Close drawer with ESC key  
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && currentDrawerType) {
                toggleDrawer();
            }
        });

        // Add event listener for the create drawer button to clear inputs
        document.getElementById('createSupplierButton').addEventListener('click', function () {
            // Clear create form
            document.getElementById('create-name').value = '';
            document.getElementById('create-address').value = '';
            document.getElementById('create-phone').value = '';
            document.getElementById('create-email').value = '';
        });
    
    </script>

@endsection