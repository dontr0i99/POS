<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
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
