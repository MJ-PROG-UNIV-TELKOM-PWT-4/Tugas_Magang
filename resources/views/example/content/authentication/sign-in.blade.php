@extends('example.layouts.default.main')

@section('content')
<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = request('email');
    $password = request('password');

    $user = DB::table('users')->where('email', $email)->first();

    if (!$user || !Hash::check($password, $user->password)) {
        Session::flash('login_error', 'Email atau password salah.');
    } else {
        Session::put('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ]);
        header('Location: ' . route('index-practice'));
        exit;
    }
}
?>

<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
    <a href="{{ url('/') }}" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
        <img src="https://cdn-icons-png.flaticon.com/128/3638/3638928.png" class="mr-4 h-11" alt="FlowBite Logo">
        <span>Stockify</span>
    </a>

    <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Sign in to platform</h2>

        @if(Session::has('login_error'))
            <div class="p-4 text-red-700 bg-red-100 border border-red-400 rounded-lg">
                {{ Session::get('login_error') }}
            </div>
        @endif

        <form class="mt-8 space-y-6" method="POST" action="">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="name@company.com" required>
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
                </div>
                <a href="{{ route('forgot.post') }}" class="ml-auto text-sm text-primary-700 hover:underline dark:text-primary-500">Lost Password?</a>
            </div>
            <button type="submit" class="w-full px-5 py-3 text-base font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700">Login to your account</button>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                Not registered? <a href="{{ route('register.form') }}" class="text-primary-700 hover:underline dark:text-primary-500">Create account</a>
            </div>
        </form>
    </div>
</div>
@endsection
