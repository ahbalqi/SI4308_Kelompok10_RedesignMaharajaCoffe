<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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
    return view('adminlte.master');
});
Route::get('/index', function(){
    return view ('items.index');
});

Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts',[PostController::class ,'store']);
Route::get('/posts', [PostController::class , 'index']);
Route::get('/posts/{id}', [PostController::class , 'show'])->name('show');
Route::get('/posts/{id}/edit', [PostController::class , 'edit'])->name('edit');
Route::put('/posts/{id}',[PostController::class,'update']);
Route::delete('/posts/{id}',[PostController::class,'delete']);