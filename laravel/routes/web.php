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
Route::get('/quotes', [App\Http\Controllers\HomeController::class, 'quotes'])->name('quotes');
Route::get('/users', function () {
    $users = DB::table('users')->get();
    return view('users', ['users' => $users]);
})->name('users');
Route::get('/user/{username}', function ($username) {
    $user = DB::table('users')->where('username', $username)->first();
    return view('user', ['user' => $user]);
})->name('user');
