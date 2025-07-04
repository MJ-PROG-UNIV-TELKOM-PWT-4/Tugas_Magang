<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman login
Route::get('/login', function () {
    return view('example.content.authentication.sign-in', [
        'title' => 'Login'
    ]);
})->name('login.form');

// Rute untuk proses login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

// Rute untuk halaman pendaftaran
Route::get('/register', function () {
    return view('example.content.authentication.sign-up', [
        'title' => 'Register'
    ]);
})->name('register.form');

// Rute untuk proses pendaftaran
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Rute untuk halaman dashboard
Route::name('index-practice')->get('Dashboard', function () {
    return view('pages.practice.index');
});

// Rute untuk halaman praktik
Route::name('practice.')->group(function () {
    Route::name('first')->get('Produk', function () {
        return view('pages.practice.1');
    });
    Route::name('second')->get('Stok', function () {
        return view('pages.practice.2');
    });
    Route::name('third')->get('Supplier', function () {
        return view('pages.practice.3');
    });
    Route::name('fourth')->get('Pengguna', function () {
        return view('pages.practice.4');
    });
    Route::name('fifth')->get('Laporan', function () {
        return view('pages.practice.5');
    });
    Route::name('sixth')->get('Pengaturan', function () {
        return view('pages.practice.6');
    });
});