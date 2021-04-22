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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customers', [App\Http\Controllers\HomeController::class, 'customers'])->name('customers');
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
// Quotes
Route::get('/quotes', [App\Http\Controllers\QuoteController::class, 'index'])->name('quotes.index');
Route::get('/quotes/create', [App\Http\Controllers\QuoteController::class, 'create'])->name('quotes.create');
Route::post('/quotes/create', [App\Http\Controllers\QuoteController::class, 'store'])->name('quotes.store');
Route::get('/quotes/{id}', [App\Http\Controllers\QuoteController::class, 'show'])->name('quotes.show');
Route::get('/quotes/{id}/edit', [App\Http\Controllers\QuoteController::class, 'edit'])->name('quotes.edit');
Route::post('/quotes/{id}/edit', [App\Http\Controllers\QuoteController::class, 'update'])->name('quotes.update');
// Users
Route::get('/users', function () {
    $users = \App\Models\User::all();
    return view('users', compact('users'));
})->name('users');
Route::get('/user/{id}', function ($id) {
    $user = \App\Models\User::find($id);
    return view('user', compact('user'));
})->name('user');
Route::post('/user/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'update'])->name('user.update');
Route::post('/quotes/{id}/convert', [App\Http\Controllers\Auth\QuoteController::class, 'convert'])->name('quotes.convert');
Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');