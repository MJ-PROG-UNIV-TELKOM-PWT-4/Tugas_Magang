<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\CategoriesController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\StockController;
use App\Http\Controllers\Auth\SupplierController;
use App\Http\Controllers\Auth\LaporanController;


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

// Halaman terms and conditions
Route::get('/terms and conditions', function () {
    return view('example.content.authentication.terms', [
        'title' => 'Terms and Conditions'
    ]);
})->name('terms.form');

// Halaman privacy policy
Route::get('/privacy policy', function () {
    return view('example.content.authentication.privacy', [
        'title' => 'Privacy Policy'
    ]);
})->name('privacy.form');

// Halaman licensing
Route::get('/licensing', function () {
    return view('example.content.authentication.licensing', [
        'title' => 'Licensing'
    ]);
})->name('licensing.form');

// Halaman cookie policy
Route::get('/cookie policy', function () {
    return view('example.content.authentication.cookie', [
        'title' => 'Cookie Policy'
    ]);
})->name('cookie.form');

// Halaman contact
Route::get('/contact', function () {
    return view('example.content.authentication.contact', [
        'title' => 'Contact'
    ]);
})->name('contact.form');

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

// Halaman Admin Dashboard
Route::get('/staff-dashboard', function () {
    return view('pages.practice.StaffGudangDashboard');
})->name('dashboard');

// Halaman Admin Dashboard
Route::get('/dashboard', function () {
    return view('pages.practice.AdminDashboard');
})->name('dashboard');

// Routing ke halaman-halaman praktik Admin
Route::name('practice.')->group(function () {
    Route::name('first')->get('admin-produk', function () {
        return view('pages.practice.AdminProduk');
    });
    Route::name('second')->get('admin-stok', function () {
        return view('pages.practice.AdminStok');
    });
    Route::name('third')->get('admin-supplier', function () {
        return view('pages.practice.AdminSupplier');
    });
    Route::name('fourth')->get('admin-pengguna', function () {
        return view('pages.practice.AdminPengguna');
    });
    Route::name('fifth')->get('admin-laporan', function () {
        return view('pages.practice.AdminLaporan');
    });
    Route::name('sixth')->get('admin-pengaturan', function () {
        return view('pages.practice.AdminPengaturan');
    });
});

// Routing ke halaman-halaman praktik Manager Gudang
Route::name('practice.')->group(function () {
    Route::name('seventh')->get('manager-produk', function () {
        return view('pages.practice.ManagerGudangProduk');
    });
    Route::name('eighth')->get('manager-stok', function () {
        return view('pages.practice.ManagerGudangStok');
    });
    Route::name('ninth')->get('manager-supplier', function () {
        return view('pages.practice.ManagerGudangSupplier');
    });
    Route::name('tenth')->get('manager-laporan', function () {
        return view('pages.practice.ManagerGudangLaporan');
    });
});

// Routing ke halaman-halaman praktik Staff Gudang
Route::name('practice.')->group(function () {
    Route::name('eleventh')->get('staff-stok', function () {
        return view('pages.practice.StaffGudangStok');
    });
});

// Routing ke Admin Dashboard
Route::get('/dashboard', [LaporanController::class, 'dashboard'])->name('dashboard.index');

// Routing ke Admin table Produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Routing ke Admin table Kategori
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

// Routing ke Admin table Supplier
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

// Routing ke Admin table Pengguna
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Routing ke Admin table Stok
Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
Route::post('/stock/update/{productId}', [StockController::class, 'updateStock'])->name('stock.update');
Route::post('/stock/minimum/{productId}', [StockController::class, 'updateMinimumStock'])->name('stock.minimum');

// Routing ke Admin table Laporan
Route::get('/admin-laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::post('/stock/minimum/{id}', [ProductController::class, 'updateMinimumStock'])->name('products.minimumStock');

