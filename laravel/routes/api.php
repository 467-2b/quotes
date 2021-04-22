<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post ( '/lineitems/update', [App\Http\Controllers\LineItemController::class, 'update'])->name('api.lineitems.update');

Route::post ( '/lineitems/destroy', [App\Http\Controllers\LineItemController::class, 'destroy'])->name('api.lineitems.destroy');

Route::post ( '/lineitems/create', [App\Http\Controllers\LineItemController::class, 'create'])->name('api.lineitems.create');

