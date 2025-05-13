<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\KategoriModel;
use Monolog\Level;

Route::pattern('id', '[0-9]+'); // ketika ada parameter {id} maka hanya berupa angka saja

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () { // semua rute di dalam group ini harus login dulu

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/', [WelcomeController::class, 'index']);

        // route level

    // artinya semua route didalam group ini harus punya role ADM (admin)
    Route::middleware(['authorize:ADM'])->group(function () {
        Route::get('/', [LevelController::class, 'index']);
        Route::post('/list', [LevelController::class, 'list']);
        Route::get('/create', [LevelController::class, 'create']);
        Route::post('/', [LevelController::class, 'store']);
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('/ajax', [LevelController::class, 'store_ajax']);
        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::get('{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::delete('/{id}', [LevelController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/list', [UserController::class, 'list']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);
        Route::post('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::get('/{id}/edit', [UserController::class, 'edit']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::get('{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    });

    Route::group(['prefix' => 'level'], function () {
        Route::get('/', [LevelController::class, 'index']);          // <enampilkan halaman awal level
        Route::post('/list', [LevelController::class, 'list']);      // Menampilkan data level dalam bentuk json untuk datatables
        Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
        Route::post('/', [LevelController::class, 'store']); 
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);     // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']);            // Menyimpan data user baru Ajax
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);   // Menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data level Ajax        // menyimpan data level baru
        Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
        Route::get('/{id}/edit', [LevelController::class, 'edit']);  // Menampilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']); 
        Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);          // <enampilkan halaman awal kategori
        Route::post('/list', [KategoriController::class, 'list']);      // Menampilkan data kategori dalam bentuk json untuk datatables
        Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
        Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);     // Menampilkan halaman form tambah kategori Ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);            // Menyimpan data kategori baru Ajax
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);        // Menampilkan halaman form edit kategori Ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);   // Menyimpan perubahan data kategori Ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete level Ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk hapus data level Ajax
        Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // Menampilkan halaman form edit kategori
        Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
        Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
    });

    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/', [SupplierController::class, 'index']);          // <enampilkan halaman awal suplier
        Route::post('/list', [SupplierController::class, 'list']);      // Menampilkan data suplier dalam bentuk json untuk datatables
        Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah suplier
        Route::post('/', [SupplierController::class, 'store']);         // menyimpan data suplier baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);         // Menampilkan halaman form tambah suplier Ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);                // Menyimpan data suplier baru Ajax
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);        // Menampilkan halaman form edit suplier Ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);    // Menyimpan perubahan data suplier Ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);   // Untuk tampilkan form confirm delete level Ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk hapus data level Ajax
        Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail suplier
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // Menampilkan halaman form edit suplier
        Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data suplier
        Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data suplier
    });

    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']);          // <enampilkan halaman awal barang
        Route::post('/list', [BarangController::class, 'list']);      // Menampilkan data barang dalam bentuk json untuk datatables
        Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
        Route::post('/', [BarangController::class, 'store']);         // menyimpan data barang baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);           // Menampilkan halaman form tambah barang Ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']);                  // Menyimpan data barang baru Ajax
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);          // Menampilkan halaman form edit barang Ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);      // Menyimpan perubahan data barang Ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);     // Untuk tampilkan form confirm delete level Ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);   // Untuk hapus data level Ajax
        Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
        Route::get('/{id}/edit', [BarangController::class, 'edit']);  // Menampilkan halaman form edit barang
        Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
        Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
    });
});