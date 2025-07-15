@extends('layouts.dashboard')  
@section('content')  

@php  
    $users = Illuminate\Support\Facades\DB::table('users')->get(); 
@endphp  

<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">  
    <div class="w-full mb-1">  
        <div class="mb-4">  
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Manage Pengguna</h1>  
        </div>  

        <div class="items-center justify-between block sm:flex">  
            <div class="flex items-center mb-4 sm:mb-0">  
                <form class="sm:pr-3" action="#" method="GET">  
                    <label for="users-search" class="sr-only">Search</label>  
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">  
                        <input type="text" name="search" id="users-search" oninput="filterUsers()" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for users">  
                    </div>  
                </form>  
            </div>

            <button id="createUserButton" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800" type="button" onclick="toggleUserDrawer('create')">
                Tambah Pengguna Baru
            </button>  
        </div>  
    </div>  
</div>  

<div class="flex flex-col">  
    <div class="overflow-x-auto">  
        <div class="inline-block min-w-full align-middle">  
            <div class="overflow-hidden shadow">  
                <table id="user-table" class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">  
                    <thead class="bg-gray-100 dark:bg-gray-700">  
                        <tr>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">No</th>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Nama Pengguna</th>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Email Pengguna</th>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Password</th>  
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Posisi</th>
                            <th scope="col" class="p-4 text-xs font-bold text-left text-gray-500 uppercase dark:text-gray-400">Actions</th>
                        </tr>  
                    </thead>  
                    <tbody id="user-body" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">  
                        @foreach($users as $index => $user)  
                        <tr class="user-row hover:bg-gray-100 dark:hover:bg-gray-700">  
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $index + 1 }}</td>  
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $user->name }}</td>  
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $user->email }}</td>  
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $user->password }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">{{ $user->role }}</td>  
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <button type="button" onclick="openUserUpdateDrawer({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ addslashes($user->password) }}', '{{ addslashes($user->role) }}')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                                    Update  
                                </button>  

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">  
                                    @csrf  
                                    @method('DELETE')  
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">  
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

<!-- Overlay untuk menutup drawer ketika diklik di luar -->
<div id="drawer-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" onclick="toggleUserDrawer()"></div>

<!-- Drawer untuk Tambah Pengguna -->
<div id="user-drawer-create" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">
    <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">Tambah Pengguna Baru</h5>
    <button type="button" onclick="toggleUserDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="create-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengguna</label>
                <input type="text" name="name" id="create-name" value="{{ old('name') }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama pengguna">
            </div>
            <div>
                <label for="create-role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Posisi</label>
                <select name="role" id="create-role" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    <option value="" disabled selected>Pilih Posisi</option>
                    <option value="Admin">Admin</option>
                    <option value="Staff Gudang">Staff Gudang</option>
                    <option value="Manajer Gudang">Manajer Gudang</option>
                </select>
            </div>
            <div>
                <label for="create-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Pengguna</label>
                <input type="email" name="email" id="create-email" value="{{ old('email') }}" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan email pengguna">
            </div>
            <div>
                <label for="create-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="create-password" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan password pengguna">
            </div>
        </div>
        <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">  
            <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                Tambah Pengguna  
            </button>  
            <button type="button" onclick="toggleUserDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">  
                Batal  
            </button>  
        </div>  
    </form>  
</div>

<!-- Drawer untuk Update Pengguna -->
<div id="user-drawer-update" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform duration-300 transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1">
    <h5 class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400 cursor-move">Update Pengguna</h5>
    <button type="button" onclick="toggleUserDrawer()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <form id="update-user-form" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="update-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengguna</label>
                <input type="text" name="name" id="update-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
            <div>
                <label for="update-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Pengguna</label>
                <input type="email" name="email" id="update-email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
            </div>
            <div>
                <label for="update-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="text" name="password" id="update-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type user password (leave empty to keep unchanged)">
            </div>
            <div>
                <label for="update-role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Posisi</label>
                <select name="role" id="update-role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    <option value="Admin">Admin</option>
                    <option value="Staff Gudang">Staff Gudang</option>
                    <option value="Manajer Gudang">Manajer Gudang</option>
                </select>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 flex justify-center w-full p-4 space-x-4">  
            <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">  
                Update Pengguna  
            </button>  
            <button type="button" onclick="toggleUserDrawer()" class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">  
                Batal  
            </button>  
        </div>  
    </form>  
</div>

<script>
    // Function untuk menyaring pengguna berdasarkan kata kunci pencarian
    function filterUsers() {
        const searchInput = document.getElementById('users-search').value.toLowerCase();
        const userRows = document.querySelectorAll('.user-row');

        userRows.forEach(row => {
            const userName = row.querySelector('td:nth-child(2)').textContent.toLowerCase(); // Mengambil nama pengguna
            const userEmail = row.querySelector('td:nth-child(3)').textContent.toLowerCase(); // Mengambil email pengguna
            const userRole = row.querySelector('td:nth-child(5)').textContent.toLowerCase(); // Mengambil posisi pengguna

            // Menampilkan atau menyembunyikan baris berdasarkan pencarian
            if (userName.includes(searchInput) || userEmail.includes(searchInput) || userRole.includes(searchInput)) {
                row.style.display = ''; // Menampilkan baris
            } else {
                row.style.display = 'none'; // Menyembunyikan baris
            }
        });
    }

    let currentUserDrawerType = null; 

    // Function untuk toggle drawer pengguna
    function toggleUserDrawer(type = null) {  
        const createDrawer = document.getElementById('user-drawer-create');  
        const updateDrawer = document.getElementById('user-drawer-update');  
        const overlay = document.getElementById('drawer-overlay');
        
        // Close current drawer if exists
        if (currentUserDrawerType) {  
            const currentDrawer = currentUserDrawerType === 'create' ? createDrawer : updateDrawer;   
            currentDrawer.classList.remove('translate-x-0');  
            currentDrawer.classList.add('translate-x-full');  
            overlay.classList.add('hidden'); // Sembunyikan overlay
            currentUserDrawerType = null;  
        }  

        // Open the drawer if the type is provided  
        if (type) {  
            const targetDrawer = type === 'create' ? createDrawer : updateDrawer;  
            targetDrawer.classList.remove('translate-x-full');  
            targetDrawer.classList.add('translate-x-0');  
            overlay.classList.remove('hidden'); // Tampilkan overlay
            currentUserDrawerType = type;  
        }  
    }

    // Function untuk membuka drawer update pengguna
    function openUserUpdateDrawer(id, name, email, password, role) {
        document.getElementById('update-user-form').action = `/users/${id}`; // Set action dari form update
        document.getElementById('update-name').value = name;
        document.getElementById('update-email').value = email;
        document.getElementById('update-password').value = password; // Biarkan kosong jika mau
        document.getElementById('update-role').value = role;

        // Open the update drawer
        toggleUserDrawer('update');
    }

    // Event listener untuk menutup drawer dengan ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && currentUserDrawerType) {
            toggleUserDrawer();
        }
    });

    // Mencegah event bubbling ketika mengklik di dalam drawer
    document.getElementById('user-drawer-create').addEventListener('click', function(event) {
        event.stopPropagation();
    });

    document.getElementById('user-drawer-update').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>

@endsection