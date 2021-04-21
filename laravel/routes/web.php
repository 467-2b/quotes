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
Route::get('/quote/{id}', [App\Http\Controllers\QuoteController::class, 'quote'])->name('quote');
Route::get('/quotes', [App\Http\Controllers\QuoteController::class, 'index'])->name('quotes');
Route::get('/quotes/new', [App\Http\Controllers\QuoteController::class, 'new'])->name('newquote');
Route::post('/quotes/new', [App\Http\Controllers\QuoteController::class, 'store']);
Route::get('/users', function () {
    $users = \App\Models\User::all();
    return view('users', compact('users'));
})->name('users');
Route::get('/user/{username}', function ($username) {
    $user = \App\Models\User::find($username);
    return view('user', compact('user'));
})->name('user');
