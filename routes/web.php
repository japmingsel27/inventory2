<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware('authUser')->group(function(){
    Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
    Route::post('/products/addProduct',[App\Http\Controllers\ProductsController::class, 'addProduct'])->name('products.addProduct');
    Route::post('/products/editProduct',[App\Http\Controllers\ProductsController::class, 'editProduct'])->name('products.editProduct');
    Route::post('/products/deleteProduct',[App\Http\Controllers\ProductsController::class, 'deleteProduct'])->name('products.deleteProduct');
});





