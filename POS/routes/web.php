<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'home']);
Route::get('/kategori/penjualan', [PenjualanController::class, 'penjualan']);
Route::get('/kategori/food-beverage', [ProductController::class, 'foodBeverage']);
Route::get('/kategori/beauty-health', [ProductController::class, 'beautyHealth']);
Route::get('/kategori/home-care', [ProductController::class, 'homeCare']);
Route::get('/kategori/baby-kid', [ProductController::class, 'babyKid']);
Route::get('/user/{id}/name/{name}', [UserController::class,'profile']);