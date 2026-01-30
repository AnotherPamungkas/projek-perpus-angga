<?php

use App\Http\Controllers\Admin\DataBukuController;
use App\Http\Controllers\Admin\DataKategoriController;
use App\Http\Controllers\Admin\DataPetugasController;
use App\Http\Controllers\Admin\RiwayatPeminjamanController;
use App\Http\Controllers\Admin\VerifikasiBukuController;
use App\Http\Controllers\Siswa\BukuController;
use App\Http\Controllers\Siswa\PeminjamanController;
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
require __DIR__ . '/auth.php';


// =======================
// ADMIN ROUTES
// =======================
Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');


        Route::get('/petugas', [DataPetugasController::class, 'index'])->name('admin.data-petugas.index');
        Route::get('/petugas/create', [DataPetugasController::class, 'create'])->name('admin.data-petugas.create');
        Route::post('/petugas/store', [DataPetugasController::class, 'store'])->name('admin.data-petugas.store');
        Route::get('/petugas/edit/{id}', [DataPetugasController::class, 'edit'])->name('admin.data-petugas.edit');
        Route::put('/petugas/update/{id}', [DataPetugasController::class, 'update'])->name('admin.data-petugas.update');
        Route::delete('/petugas/delete/{id}', [DataPetugasController::class, 'destroy'])->name('admin.data-petugas.destroy');


        Route::get('/data-kategori', [DataKategoriController::class, 'index'])->name('admin.data-kategori.index');
        Route::get('/data-kategori/create', [DataKategoriController::class, 'create'])->name('admin.data-kategori.create');
        Route::post('/data-kategori/store', [DataKategoriController::class, 'store'])->name('admin.data-kategori.store');
        Route::get('/data-kategori/edit/{id}', [DataKategoriController::class, 'edit'])->name('admin.data-kategori.edit');
        Route::put('/data-kategori/update/{id}', [DataKategoriController::class, 'update'])->name('admin.data-kategori.update');
        Route::delete('/data-kategori/delete/{id}', [DataKategoriController::class, 'destroy'])->name('admin.data-kategori.destroy');

        Route::get('/data-buku', [DataBukuController::class, 'index'])->name('admin.data-buku.index');
        Route::get('/data-buku/create', [DataBukuController::class, 'create'])->name('admin.data-buku.create');
        Route::post('/data-buku/store', [DataBukuController::class, 'store'])->name('admin.data-buku.store');
        Route::get('/data-buku/edit/{id}', [DataBukuController::class, 'edit'])->name('admin.data-buku.edit');
        Route::put('/data-buku/update/{id}', [DataBukuController::class, 'update'])->name('admin.data-buku.update');
        Route::delete('/data-buku/delete/{id}', [DataBukuController::class, 'destroy'])->name('admin.data-buku.destroy');

        Route::get('/verifikasi-buku', [VerifikasiBukuController::class, 'index'])
            ->name('admin.verifikasi-buku.index');

        Route::get('/verifikasi-buku/{buku}', [VerifikasiBukuController::class, 'detail'])
            ->name('admin.verifikasi-buku.detail');

        Route::post('/verifikasi-buku/{buku}/verify', [VerifikasiBukuController::class, 'verify'])
            ->name('admin.verifikasi-buku.verify');

        Route::post('/verifikasi-buku/{buku}/reject', [VerifikasiBukuController::class, 'reject'])
            ->name('admin.verifikasi-buku.reject');


        Route::get('/riwayat-peminjaman', [RiwayatPeminjamanController::class, 'index'])
            ->name('admin.riwayat-peminjaman.index');

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

        Route::get('/buku', [BukuController::class, 'index'])
            ->name('siswa.buku.index');

        Route::get('/buku/{buku}', [BukuController::class, 'detail'])
            ->name('siswa.buku.detail');

        // peminjaman
        Route::get('/peminjaman/{buku}', [PeminjamanController::class, 'create'])
            ->name('siswa.peminjaman.create');

        Route::post('/peminjaman', [PeminjamanController::class, 'store'])
            ->name('siswa.peminjaman.store');
    });
