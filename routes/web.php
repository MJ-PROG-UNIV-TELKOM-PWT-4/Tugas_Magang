<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah kamu bisa mendaftarkan semua rute web untuk aplikasi kamu.
| File ini dimuat oleh RouteServiceProvider dan semuanya otomatis masuk ke 
| middleware group "web".
|
*/

// Redirect ke root
Route::get('/', function () {
    return redirect()->route('login.form');
})->name('home');

// Halaman login
Route::get('/login', function () {
    return view('example.content.authentication.sign-in', [
        'title' => 'Login'
    ]);
})->name('login.form');

// Proses Login
Route::post('/login', [SignInController::class, 'authenticate'])->name('login.post');

// Cek login
Route::get('/cek-login', function () {
    if (Auth::check()) {
        return '    Sudah login sebagai: ' . Auth::user()->name;
    } else {
        return 'Belum login!';
    }
});

// Cek Auth
Route::get('/cek-auth', function () {
    return Auth::user();
});

// Halaman registrasi
Route::get('/register', function () {
    return view('example.content.authentication.sign-up', [
        'title' => 'Register'
    ]);
})->name('register.form');

// Proses sign-up
Route::post('/register', [SignUpController::class, 'register'])->name('register.post');

// Halaman forgotten password
Route::get('/forgot', function () {
    return view('example.content.authentication.forgot-password', [
        'title' => 'Forgot Password'
    ]);
})->name('forgot.form');

// Proses reset password
Route::post('/forgot', [ForgotPasswordController::class, 'forgot'])->name('forgot.post');

// Halaman form reset password
Route::get('/reset/{email}', function ($email) {
    return view('example.content.authentication.reset-password', [
        'email' => $email,
        'title' => 'Reset Password'
    ]);
})->name('reset.form');

// Proses reset password
Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('reset.post');

// Proses logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Berhasil logout!');
})->name('logout');

// Halaman dashboard utama
Route::get('/dashboard', function () {
    return view('pages.practice.index');
})->name('dashboard');

// Routing ke halaman-halaman praktik
Route::name('practice.')->group(function () {
    Route::name('first')->get('produk', function () {
        return view('pages.practice.1');
    });
    Route::name('second')->get('stok', function () {
        return view('pages.practice.2');
    });
    Route::name('third')->get('supplier', function () {
        return view('pages.practice.3');
    });
    Route::name('fourth')->get('pengguna', function () {
        return view('pages.practice.4');
    });
    Route::name('fifth')->get('laporan', function () {
        return view('pages.practice.5');
    });
    Route::name('sixth')->get('pengaturan', function () {
        return view('pages.practice.6');
    });
});
