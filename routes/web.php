<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;
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

Route::controller(AuthController::class)->group(function() {
    // Route::get('/login', 'login')->middleware('isLogin');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'doLogin')->name('do.login');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'doRegister')->name('do.register');
});

// Route::middleware('auth')->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        });
        
        Route::resource('/category', CategoryController::class);
        Route::resource('/product', ProductController::class);

        Route::prefix('stock')->group(function() {
            // Stock Masuk
            Route::get('/masuk', function() {
                return view('admin.stock.masuk.index');
            });
            Route::get('/masuk/form', function() {
                return view('admin.stock.masuk.form');
            });
            
            // Stock Keluar
            Route::get('/keluar', function() {
                return view('admin.stock.keluar.index');
            });
            Route::get('/keluar/form', function() {
                return view('admin.stock.keluar.form');
            });
            
            // Sisa Stock
            Route::get('/sisa', function() {
                return view('admin.stock.sisa.index');
            });
        });

        Route::get('/transaction', function () {
            return view('admin.transaction.index');
        });
    });

// });

 // Home
 Route::get('/', function () {
    return view('welcome');
});
