<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

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
    
    Route::resource('/category', CategoryController::class);

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