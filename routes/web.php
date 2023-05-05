<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    });
    
    // Kategori
    Route::get('/category', function () {
        return view('admin.category.index');
    });
    Route::get('/category/create', function () {
        return view('admin.category.add');
    });
    Route::get('/category/edit', function () {
        return view('admin.category.edit');
    });

    // Produk
    Route::get('/product', function () {
        return view('admin.product.index');
    });
    Route::get('/product/create', function () {
        return view('admin.product.add');
    });
    Route::get('/product/edit', function () {
        return view('admin.product.edit');
    });

    Route::get('/transaction', function () {
        return view('admin.transaction.index');
    });

});