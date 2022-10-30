<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TagihanController;

Route::group([
    'middleware' => 'guest',
], function() {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    // Route::get('/dashboard', [AuthController::class, 'login'])->name('login');
});

Route::group([
    'middleware' => 'auth',
], function() {
    Route::get('/dashboard', function () {
        return view('components.menus.dashboard');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/user/{id}', [UserController::class, 'show'])->name('user');
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user', [UserController::class, 'store']);
    Route::post('/user/{id}', [UserController::class, 'edit']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::post('/kategori/{id}', [KategoriController::class, 'edit']);
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('kelas');
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::post('/kelas/{id}', [KelasController::class, 'edit']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

    Route::get('/pendaftaran', [TagihanController::class, 'indexDaftar'])->name('pendaftaran');

    Route::get('/tagihan/{id}', [TagihanController::class, 'show'])->name('tagihan');
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan');
    Route::post('/tagihan', [TagihanController::class, 'store']);
    Route::post('/tagihan/{id}', [TagihanController::class, 'edit']);
    Route::delete('/tagihan/{id}', [TagihanController::class, 'destroy']);

    // Route::post('/tagihan/{id}', [TagihanController::class, 'verification'])->name('verif');



    Route::post('/namaMember', [PendaftaranController::class, 'namaMember']);
    Route::post('/kelasMember', [PendaftaranController::class, 'kelasMember']);

});
