<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\InStockController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OutStockController;
use App\Http\Controllers\Admin\RemainingStockController;


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

Route::controller(AuthController::class)->group(function () {
    // Route::get('/login', 'login')->middleware('isLogin');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'doLogin')->name('do.login');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'doRegister')->name('do.register');
});

// Route::middleware('auth')->group(function() {
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    });

    // Category
    Route::resource('/category', CategoryController::class);

    // Product
    Route::resource('/product', ProductController::class);

    // Stock
    Route::prefix('stock')->group(function () {
        // Stock Masuk
        Route::resource('/masuk', InStockController::class);

        // Stock Keluar
        Route::get('/keluar', [OutStockController::class, 'index']);
    });

    // Transaction
    Route::get('/transaction', function () {
        return view('admin.transaction.index');
    });
    
    // FAQ
    Route::resource('/faq', FaqController::class);
});

// });

// Home
Route::get('/', function () {
    return view('welcome');
});
