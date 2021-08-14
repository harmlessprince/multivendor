<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
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
Route::get('/cart', [CartController::class, 'index'])->middleware(['auth'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class, 'add'])->middleware(['auth'])->name('cart.add');
Route::get('/cart/update/{id}', [CartController::class, 'update'])->middleware(['auth'])->name('cart.update');
Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->middleware(['auth'])->name('cart.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
