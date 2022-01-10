<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [FrontpageController::class, 'index']);
Route::get('/search', [FrontpageController::class, 'search']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/auth/do_login', [AuthController::class, 'do_login']);

Route::get('/auth/logout', [AuthController::class, 'do_logout']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/auth/do_register', [AuthController::class, 'do_register']);

Route::prefix('cart')->name('cart')->group(function () {
    Route::get('insert/{id}', [CartController::class, 'add']);
    Route::get('delete/{id}', [CartController::class, 'delete']);
    Route::get('checkout', [CartController::class, 'checkout']);
});

Route::prefix('profile')->name('profile')->group(function () {
    Route::get('', [ProfileController::class, 'index']);
    Route::get('cart', [ProfileController::class, 'cart']);
    Route::get('order', [ProfileController::class, 'order']);
    Route::get('order/{id}', [ProfileController::class, 'order_detail']);
});
Route::post('/order/upload_proof/{order_id}', [ProfileController::class, 'upload_proof']);
Route::post('/user/update', [ProfileController::class, 'update_profile']);

Route::prefix('/dashboard/category')->name('category')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('{id}', [CategoryController::class, 'edit']);

    Route::post('insert', [CategoryController::class, 'insert']);
    Route::post('update/{id}', [CategoryController::class, 'update']);
    Route::get('delete/{id}', [CategoryController::class, 'delete']);
});

Route::prefix('/dashboard/product')->name('product')->group(function () {
    Route::get('', [ProductController::class, 'index']);
    Route::get('{id}', [ProductController::class, 'edit']);

    Route::post('insert', [ProductController::class, 'insert']);
    Route::post('update/{id}', [ProductController::class, 'update']);
    Route::get('delete/{id}', [ProductController::class, 'delete']);
});

Route::prefix('/dashboard/order')->name('order')->group(function () {
    Route::get('', [OrderController::class, 'index']);
    Route::get('{id}', [OrderController::class, 'detail']);

    Route::get('verify/{id}', [OrderController::class, 'verify']);
});



Route::get('/admin', [AuthController::class, 'login_admin']);
Route::get('/dashboard', [FrontpageController::class, 'dashboard']);


