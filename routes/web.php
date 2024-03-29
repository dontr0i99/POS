<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelCotroller;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [HomeController::class,'home']);

Route::prefix('category')->group(function (){
    Route::get('/foodBeverage', [ProductsController::class,'foodBeverage']);
    Route::get('/beautyHealth', [ProductsController::class,'beautyHealth']);
    Route::get('/homeCare', [ProductsController::class,'homeCare']);
    Route::get('/babyKid', [ProductsController::class,'babyKid']);
});

Route::get('/user/{id}/name/{name}', [UserController::class,'user']);

Route::get('/sales', [PenjualanController::class,'sales']);

Route::get('/level', [LevelCotroller::class, 'index']);

Route::get('/kategori',  [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);