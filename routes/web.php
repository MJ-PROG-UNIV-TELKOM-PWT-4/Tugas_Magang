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

// Redirect ke root
Route::get('/', function () {
    return redirect()->route('login.form');
})->name('home');

// Autentikasi dan lain-lain
Route::get('/login', fn() => view('example.content.authentication.sign-in', ['title' => 'Login']))->name('login.form');
Route::post('/login', [SignInController::class, 'authenticate'])->name('login.post');
Route::get('/cek-login', fn() => Auth::check() ? 'Sudah login sebagai: ' . Auth::user()->name : 'Belum login!');
Route::get('/cek-auth', fn() => Auth::user());

Route::get('/register', fn() => view('example.content.authentication.sign-up', ['title' => 'Register']))->name('register.form');
Route::post('/register', [SignUpController::class, 'register'])->name('register.post');

Route::get('/terms and conditions', fn() => view('example.content.authentication.terms', ['title' => 'Terms and Conditions']))->name('terms.form');
Route::get('/privacy policy', fn() => view('example.content.authentication.privacy', ['title' => 'Privacy Policy']))->name('privacy.form');
Route::get('/licensing', fn() => view('example.content.authentication.licensing', ['title' => 'Licensing']))->name('licensing.form');
Route::get('/cookie policy', fn() => view('example.content.authentication.cookie', ['title' => 'Cookie Policy']))->name('cookie.form');
Route::get('/contact', fn() => view('example.content.authentication.contact', ['title' => 'Contact']))->name('contact.form');

Route::get('/forgot', fn() => view('example.content.authentication.forgot-password', ['title' => 'Forgot Password']))->name('forgot.form');
Route::post('/forgot', [ForgotPasswordController::class, 'forgot'])->name('forgot.post');
Route::get('/reset/{email}', fn($email) => view('example.content.authentication.reset-password', ['email' => $email, 'title' => 'Reset Password']))->name('reset.form');
Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('reset.post');

Route::post('/logout', fn() => tap(Auth::logout(), fn() => redirect('/login')->with('success', 'Berhasil logout!')))->name('logout');

// Dashboard berdasarkan role
Route::get('/manager-dashboard', fn() => view('pages.practice.ManagerGudangDashboard'))->name('dashboard.manager')->middleware('role:Manajer Gudang');
Route::get('/staff-dashboard', fn() => view('pages.practice.StaffGudangDashboard'))->name('dashboard.staff')->middleware('role:Staff Gudang');
Route::get('/admin-dashboard', fn() => view('pages.practice.AdminDashboard'))->name('dashboard.admin')->middleware('role:Admin');

// Halaman praktik berdasarkan role
Route::name('practice.')->middleware('role:Admin')->group(function () {
    Route::name('first')->get('admin-produk', fn() => view('pages.practice.AdminProduk'));
    Route::name('second')->get('admin-stok', fn() => view('pages.practice.AdminStok'));
    Route::name('third')->get('admin-supplier', fn() => view('pages.practice.AdminSupplier'));
    Route::name('fourth')->get('admin-pengguna', fn() => view('pages.practice.AdminPengguna'));
    Route::name('fifth')->get('admin-laporan', fn() => view('pages.practice.AdminLaporan'));
    Route::name('sixth')->get('admin-pengaturan', fn() => view('pages.practice.AdminPengaturan'));
});

Route::name('practice.')->middleware('role:Manajer Gudang')->group(function () {
    Route::name('seventh')->get('manager-produk', fn() => view('pages.practice.ManagerGudangProduk'));
    Route::name('eighth')->get('manager-stok', fn() => view('pages.practice.ManagerGudangStok'));
    Route::name('ninth')->get('manager-supplier', fn() => view('pages.practice.ManagerGudangSupplier'));
});

Route::name('practice.')->middleware('role:Staff Gudang')->group(function () {
    Route::name('eleventh')->get('staff-stok', fn() => view('pages.practice.StaffGudangStok'));
});

// Dashboard Admin pakai controller
Route::get('/admin-dashboard', [LaporanController::class, 'dashboard'])->name('dashboard.index')->middleware('role:Admin');

// Routing ke Admin table Produk
Route::middleware('role:Admin')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/export-pdf', [ProductController::class, 'exportPdf'])->name('products.export.pdf');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
    Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');

    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('/stock/minimum/{productId}', [StockController::class, 'updateMinimumStock'])->name('stock.minimum');

    Route::get('/admin-laporan', [LaporanController::class, 'index'])->name('laporan.index');
});

// Routing untuk update stok: TERBUKA untuk 3 ROLE
Route::post('/stock/update/{productId}', [StockController::class, 'updateStock'])
    ->middleware(['role:Admin,Manajer Gudang,Staff Gudang'])
    ->name('stock.update');

// Routing laporan manager gudang
Route::get('/manager-laporan', [LaporanController::class, 'managerGudangLaporan'])->name('manager.laporan')->middleware('role:Manajer Gudang');

// Routing minimum stok oleh Admin
Route::post('/stock/minimum/{id}', [ProductController::class, 'updateMinimumStock'])->name('products.minimumStock')->middleware('role:Admin');
