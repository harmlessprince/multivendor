<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('add/{id}', [CartController::class, 'add'])->name('add');
        Route::get('update/{id}', [CartController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [CartController::class, 'destroy'])->name('destroy');
        Route::get('clear', [CartController::class, 'clear'])->name('clear');
        Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    });
    Route::prefix('order')->name('order.')->group(function () {
       Route::post('/', [OrderController::class, 'store'])->name('store');
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



require __DIR__ . '/auth.php';
