<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ProductController::class, 'productList'])->name('product.productList');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::post('transaction', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/tesqr', [TransactionController::class, 'tesQR']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(
    function () {  //grouping route hanya boleh diakases ketika login
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('user', UserController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('product', ProductController::class);
        Route::resource('setting', SettingController::class);
        Route::get('transaction', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('transaction/create', [TransactionController::class, 'create'])->name('transaction.create');
        Route::get('transaction/{transaction}/edit', [TransactionController::class, 'edit'])->name('transaction.edit');
        Route::get('transaction/{transaction}', [TransactionController::class, 'getTransByQR'])->name('transaction.getTransByQR');
        Route::get('transaction/{transaction}/struk', [TransactionController::class, 'struk'])->name('transaction.struk');
        Route::put('transaction/{transaction}', [TransactionController::class, 'update'])->name('transaction.update');
        Route::get('transaction/cetak/{startdate}/{enddate}', [TransactionController::class, 'cetakTransaction'])->name('transaction.cetak');
    }
);
