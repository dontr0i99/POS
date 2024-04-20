<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelCotroller;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
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

Route::get('/kategori',  [KategoriController::class, 'index'])->name('/kategori');
Route::get('/user', [UserController::class, 'index']);

Route::get('user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/',function(){
    return view('welcome');
});

Route::get('/kategori/create',[KategoriController::class,'create'])->name('/kategori/create');
Route::post('/kategori',[KategoriController::class,'store']);
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('/kategori/edit');
Route::put('/kategori/edit_save/{id}', [KategoriController::class, 'edit_save'])->name('/kategori/update');
Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('/kategori/hapus');

Route::get('/user/create',[UsersController::class,'create'])->name('/user/create');
Route::get('/level/create',[LevelCotroller::class,'create'])->name('/level/create');