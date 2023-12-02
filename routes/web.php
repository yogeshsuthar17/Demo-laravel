<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\ReceivedGoodsController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CategoryController;
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

Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('post-login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'getRegister'])->name('register');
Route::post('/post-register', [AuthController::class, 'postRegister'])->name('post-register');

Route::group(['middleware' => ['auth']], function () { 

    Route::resource('goods', GoodsController::class);
    Route::get('/goods-sort', [GoodsController::class, 'sort'])->name('goods-sort');
    Route::get('/goods-search', [GoodsController::class, 'search'])->name('goods-search');
    Route::get('goods_export',[GoodsController::class, 'get_supplier_data'])->name('goods.export');

    Route::resource('category', CategoryController::class);
    Route::get('/category-sort', [CategoryController::class, 'sort'])->name('category-sort');
    Route::get('/category-search', [CategoryController::class, 'search'])->name('category-search');
    Route::get('category_export',[CategoryController::class, 'get_supplier_data'])->name('category.export');

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/contact', function () {
        return view('contact');
    });
});