@extends('example.layouts.default.main')

@section('content')
<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

$errors = [];
$autoLogin = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = request('name');
    $email = request('email');
    $password = request('password');
    $password_confirmation = request('password_confirmation');
    $role = request('role');
    $terms = request('terms');

    // Validasi
    if (!$name) $errors[] = 'Nama wajib diisi.';
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid.';
    if (!$password || strlen($password) < 6) $errors[] = 'Password minimal 6 karakter.';
    if ($password !== $password_confirmation) $errors[] = 'Konfirmasi password tidak cocok.';
    if (!in_array($role, ['admin', 'manager_gudang', 'staff_gudang'])) $errors[] = 'Role tidak valid.';
    if (!$terms) $errors[] = 'Anda harus menyetujui syarat dan ketentuan.';
    if (DB::table('users')->where('email', $email)->exists()) {
        $errors[] = 'Email sudah digunakan.';
    }

    // Simpan & set auto login jika valid
    if (empty($errors)) {
        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => match($role) {
                'admin' => 'Admin',
                'manager_gudang' => 'Manajer Gudang',
                'staff_gudang' => 'Staff Gudang',
            },
        ]);

        // Set flag untuk auto login ke sign-in.post
        $autoLogin = true;
    }
}
?>

@if ($autoLogin)
    <form id="autoLoginForm" method="POST" action="{{ route('sign-in.post') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="password" value="{{ $password }}">
    </form>
    <script>
        document.getElementById('autoLoginForm').submit();
    </script>
@endif

<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
    <a href="{{ url('/') }}" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        <img src="https://cdn-icons-png.flaticon.com/128/3638/3638928.png" class="h-8 mr-3" alt="Logo" />
        <span>Stockify</span>
    </a>

    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Create a Free Account</h2>

        @foreach ($errors as $error)
            <div class="p-4 text-red-700 bg-red-100 border border-red-400 rounded-lg">
                {{ $error }}
            </div>
        @endforeach

        <form class="mt-8 space-y-6" method="POST" action="">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Role</label>
                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="">Select a Role</option>
                    <option value="admin">Admin</option>
                    <option value="manager_gudang">Manager Gudang</option>
                    <option value="staff_gudang">Staff Gudang</option>
                </select>
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div>
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" name="terms" type="checkbox" class="w-4 h-4 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600" required>
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="font-medium text-gray-900 dark:text-white">I accept the <a href="#" class="text-primary-700 hover:underline dark:text-primary-500">Terms and Conditions</a></label>
                </div>
            </div>
            <button type="submit" class="w-full px-5 py-3 text-base font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800">Create account</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Already have an account? <a href="{{ route('login.form') }}" class="text-primary-700 hover:underline dark:text-primary-500">Login here</a>
            </div>
        </form>
    </div>
</div>
@endsection