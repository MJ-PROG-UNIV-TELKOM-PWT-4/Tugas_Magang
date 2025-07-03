<?php

use Illuminate\Support\Facades\Route;

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
Route::name('index-practice')->get('/', function () {
    return view('pages.practice.index');
});

Route::name('practice.')->group(function () {
    Route::name('first')->get('practice/1', function () {
        return view('pages.practice.1');
    });
    Route::name('second')->get('practice/2', function () {
        return view('pages.practice.2');
    });
    Route::name('third')->get('practice/3', function () {
        return view('pages.practice.3');
    });
    Route::name('fourth')->get('practice/4', function () {
        return view('pages.practice.4');
    });
    Route::name('fifth')->get('practice/5', function () {
        return view('pages.practice.5');
    });
    Route::name('sixth')->get('practice/6', function () {
        return view('pages.practice.6');
    });
});
