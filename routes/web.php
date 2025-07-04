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

// Rute untuk halaman dashboard
Route::get('/', function () {
    return redirect()->route('login.form');
})->name('home');

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

// Rute untuk halaman lupa password
Route::get('/forgot', function () {
    return view('example.content.authentication.forgot-password', [
        'title' => 'Forgot Password'
    ]);
})->name('Forgot Password.form');

// Rute untuk proses lupa password
Route::post('/forgot', [RegisterController::class, 'forgot'])->name('forgot.post');

// Rute untuk halaman praktik
Route::name('index-practice')->get('/Dashboard', function () {
    return view('pages.practice.index');
});

// Proses login
Route::post('/login', function () {
    $email = request('email');
    $password = request('password');

    $user = DB::table('users')->where('email', $email)->first();

    if (!$user || !Hash::check($password, $user->password)) {
        return back()->withErrors(['login' => 'Email atau password salah.'])->withInput();
    }

    Session::put('user', $user);
    return redirect('/dashboard');
});

// Routing ke halaman dashboard setelah login
Route::get('/dashboard', function () {
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