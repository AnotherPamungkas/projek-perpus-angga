<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// landing page
Route::get('/', function () {
    return view('welcome');
});

// =======================
// AUTH ROUTES (BREEZE)
// =======================
require __DIR__.'/auth.php';


// =======================
// ADMIN ROUTES
// =======================
Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Route::get('/buku', [\App\Http\Controllers\Admin\BukuController::class, 'index'])
        //     ->name('buku');

        // Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
        //     ->name('users');
    });


// =======================
// PETUGAS ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:petugas'])
    ->prefix('petugas')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('petugas.dashboard');
        })->name('petugas.dashboard');

        // Route::get('/peminjaman', [\App\Http\Controllers\Petugas\PeminjamanController::class, 'index'])
        //     ->name('peminjaman');

        // Route::get('/pengembalian', [\App\Http\Controllers\Petugas\PengembalianController::class, 'index'])
        //     ->name('pengembalian');
    });


// =======================
// SISWA ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:siswa'])
    ->prefix('siswa')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('siswa.dashboard');

        // Route::get('/katalog', [\App\Http\Controllers\Siswa\KatalogController::class, 'index'])
        //     ->name('katalog');

        // Route::get('/peminjaman', [\App\Http\Controllers\Siswa\PeminjamanController::class, 'index'])
        //     ->name('peminjaman');
    });
