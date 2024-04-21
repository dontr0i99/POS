<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelCotroller;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use App\Models\UserModel;
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

Route::resource('m_user',POSController::class);

Route::get('/',[WelcomeController::class,'index']);

Route::group (['prefix' =>'user'],function(){
    Route::get('/',[UsersController::class,'index']);
    Route::post('/list',[UsersController::class,'list']);
    Route::get('/create',[UsersController::class,'create']);
    Route::post('/',[UsersController::class,'store']);
    Route::get('/{id}',[UsersController::class,'show']);
    Route::get('/{id}/edit',[UsersController::class,'edit']);
    Route::put('/{id}',[UsersController::class,'update']);
    Route::delete('/{id}',[UsersController::class,'destroy']);
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelCotroller::class, 'index']);
    Route::post('/list', [LevelCotroller::class, 'list']);
    Route::get('/create', [LevelCotroller::class, 'create']);
    Route::post('/', [LevelCotroller::class, 'store']);
    Route::get('/{id}', [LevelCotroller::class, 'show']);
    Route::get('/{id}/edit', [LevelCotroller::class, 'edit']);
    Route::put('/{id}', [LevelCotroller::class, 'update']);
    Route::delete('/{id}', [LevelCotroller::class, 'destroy']);
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/list', [KategoriController::class, 'list']);
    Route::get('/create', [KategoriController::class, 'create']);
    Route::post('/', [KategoriController::class, 'store']);
    Route::get('/{id}', [KategoriController::class, 'show']);
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/list', [BarangController::class, 'list']);
    Route::get('/create', [BarangController::class, 'create']);
    Route::post('/', [BarangController::class, 'store']);
    Route::get('/{id}', [BarangController::class, 'show']);
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    Route::put('/{id}', [BarangController::class, 'update']);
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

Route::group(['prefix' => 'stok'], function(){
    Route::get('/', [StokController::class, 'index']);
    Route::post('/list', [StokController::class, 'list']);
    Route::get('/create', [StokController::class, 'create']);
    Route::post('/', [StokController::class, 'store']);
    Route::get('/{id}', [StokController::class, 'show']);
    Route::get('/{id}/edit', [StokController::class, 'edit']);
    Route::put('/{id}', [StokController::class, 'update']);
    Route::delete('/{id}', [StokController::class, 'destroy']);
});

Route::group(['prefix' => 'penjualan'], function(){
    Route::get('/', [PenjualanController::class, 'index']);
    Route::post('/list', [PenjualanController::class, 'list']);
    Route::get('/create', [PenjualanController::class, 'create']);
    Route::get('/get-harga/{id}', [PenjualanController::class, 'getHarga']);
    Route::post('/', [PenjualanController::class, 'store']);
    Route::get('/{id}', [PenjualanController::class, 'show']);
    Route::get('/{id}/edit', [PenjualanController::class, 'edit']);
    Route::put('/{id}', [PenjualanController::class, 'update']);
    Route::delete('/{id}', [PenjualanController::class, 'destroy']);
});