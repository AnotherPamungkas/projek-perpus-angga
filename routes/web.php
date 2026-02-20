<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DataBukuController;
use App\Http\Controllers\Admin\DataKategoriController;
use App\Http\Controllers\Admin\DataPeminjamController;
use App\Http\Controllers\Admin\DataPetugasController;
use App\Http\Controllers\Admin\DataUlasanController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\RiwayatPeminjamanController;
use App\Http\Controllers\Admin\VerifikasiBukuController;
use App\Http\Controllers\Peminjam\BukuController;
use App\Http\Controllers\Peminjam\DashboardController;
use App\Http\Controllers\Peminjam\PeminjamanBukuController;
use App\Http\Controllers\Peminjam\PeminjamanController;
use App\Http\Controllers\Peminjam\ProfilController;
use App\Http\Controllers\Peminjam\RiwayatPeminjamanController as PeminjamRiwayatPeminjamanController;
use App\Http\Controllers\Peminjam\UlasanController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\DataBukuController as PetugasDataBukuController;
use App\Http\Controllers\Petugas\DataKategoriController as PetugasDataKategoriController;
use App\Http\Controllers\Petugas\DataPeminjamanController;
use App\Http\Controllers\Petugas\DataUlasanController as PetugasDataUlasanController;
use App\Http\Controllers\Petugas\ProfilController as PetugasProfilController;
use App\Http\Controllers\Petugas\RiwayatPeminjamanController as PetugasRiwayatPeminjamanController;
use App\Http\Controllers\Petugas\ValidasiPeminjamanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// landing page
Route::get('/', function () {
    return view('landing-page');
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

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Manajemen data peminjam
        Route::get('/data-peminjam', [DataPeminjamController::class, 'index'])->name('admin.data-peminjam.index');
        Route::get('/data-peminjam/export', [DataPeminjamController::class, 'export'])->name('admin.data-peminjam.export');
        Route::delete('/data-peminjam/{peminjam}', [DataPeminjamController::class, 'destroy'])->name('admin.data-peminjam.destroy');


        // Manajemen data petugas
        Route::get('/data-petugas', [DataPetugasController::class, 'index'])->name('admin.data-petugas.index');
        Route::get('/data-petugas/create', [DataPetugasController::class, 'create'])->name('admin.data-petugas.create');
        Route::get('/data-petugas/edit/{id}', [DataPetugasController::class, 'edit'])->name('admin.data-petugas.edit');
        Route::get('/data-petugas/export', [DataPetugasController::class, 'export'])->name('admin.data-petugas.export');
        Route::post('/data-petugas/store', [DataPetugasController::class, 'store'])->name('admin.data-petugas.store');
        Route::put('/data-petugas/update/{id}', [DataPetugasController::class, 'update'])->name('admin.data-petugas.update');
        Route::delete('/data-petugas/delete/{id}', [DataPetugasController::class, 'destroy'])->name('admin.data-petugas.destroy');

        // Manajemen data kategori
        Route::get('/data-kategori', [DataKategoriController::class, 'index'])->name('admin.data-kategori.index');
        Route::get('/data-kategori/create', [DataKategoriController::class, 'create'])->name('admin.data-kategori.create');
        Route::post('/data-kategori/store', [DataKategoriController::class, 'store'])->name('admin.data-kategori.store');
        Route::get('/data-kategori/edit/{id}', [DataKategoriController::class, 'edit'])->name('admin.data-kategori.edit');
        Route::put('/data-kategori/update/{id}', [DataKategoriController::class, 'update'])->name('admin.data-kategori.update');
        Route::delete('/data-kategori/delete/{id}', [DataKategoriController::class, 'destroy'])->name('admin.data-kategori.destroy');

        // Manajemen data buku
        Route::get('/data-buku', [DataBukuController::class, 'index'])->name('admin.data-buku.index');
        Route::get('/data-buku/create', [DataBukuController::class, 'create'])->name('admin.data-buku.create');
        Route::get('/data-buku/export', [DataBukuController::class, 'export'])->name('admin.data-buku.export');
        Route::post('/data-buku/store', [DataBukuController::class, 'store'])->name('admin.data-buku.store');
        Route::get('/data-buku/edit/{id}', [DataBukuController::class, 'edit'])->name('admin.data-buku.edit');
        Route::put('/data-buku/update/{id}', [DataBukuController::class, 'update'])->name('admin.data-buku.update');
        Route::delete('/data-buku/delete/{buku}', [DataBukuController::class, 'destroy'])->name('admin.data-buku.destroy');

        // Manajemen riwayat peminjaman
        Route::get('/riwayat-peminjaman', [RiwayatPeminjamanController::class, 'index'])
            ->name('admin.riwayat-peminjaman');
        Route::get('/riwayat-peminjaman/export', [RiwayatPeminjamanController::class, 'export'])->name('admin.riwayat-peminjaman.export');

        // Manajemen Data Ulasan
        Route::get('/data-ulasan', [DataUlasanController::class, 'index'])->name('admin.data-ulasan.index');
        Route::get('/data-ulasan/export', [DataUlasanController::class, 'export'])->name('admin.data-ulasan.export');

        Route::get('/profil', [AdminProfilController::class, 'index'])->name('profil-admin.index');
        Route::get('/profil/edit', [AdminProfilController::class, 'edit'])->name('profil-admin.edit');
        Route::put('/profil/update', [AdminProfilController::class, 'update'])->name('profil-admin.update');
    });


// =======================
// PETUGAS ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:petugas'])
    ->prefix('petugas')
    ->group(function () {

        // Manajemen dashboard petugas
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

        // Manajemen data kategori
        Route::get('/data-kategori', [PetugasDataKategoriController::class, 'index'])->name('petugas.data-kategori.index');
        Route::get('/data-kategori/create', [PetugasDataKategoriController::class, 'create'])->name('petugas.data-kategori.create');
        Route::post('/data-kategori/store', [PetugasDataKategoriController::class, 'store'])->name('petugas.data-kategori.store');
        Route::get('/data-kategori/edit/{id}', [PetugasDataKategoriController::class, 'edit'])->name('petugas.data-kategori.edit');
        Route::put('/data-kategori/update/{id}', [PetugasDataKategoriController::class, 'update'])->name('petugas.data-kategori.update');
        Route::delete('/data-kategori/delete/{id}', [PetugasDataKategoriController::class, 'destroy'])->name('petugas.data-kategori.destroy');

        // Manajemen data buku
        Route::get('/data-buku', [PetugasDataBukuController::class, 'index'])->name('petugas.data-buku.index');
        Route::get('/data-buku/create', [PetugasDataBukuController::class, 'create'])->name('petugas.data-buku.create');
        Route::post('/data-buku/store', [PetugasDataBukuController::class, 'store'])->name('petugas.data-buku.store');
        Route::get('/data-buku/export', [PetugasDataBukuController::class, 'export'])->name('petugas.data-buku.export');
        Route::get('/data-buku/edit/{buku}', [PetugasDataBukuController::class, 'edit'])->name('petugas.data-buku.edit');
        Route::put('/data-buku/update/{buku}', [PetugasDataBukuController::class, 'update'])->name('petugas.data-buku.update');
        Route::delete('/data-buku/delete/{buku}', [PetugasDataBukuController::class, 'destroy'])->name('petugas.data-buku.destroy');

        // Manajemen validasi peminjaman
        Route::get('/validasi-peminjaman', [ValidasiPeminjamanController::class, 'index'])->name('petugas.validasi-peminjaman.index');
        Route::get('/validasi-peminjaman/detail/{peminjaman}', [ValidasiPeminjamanController::class, 'detail'])->name('petugas.validasi-peminjaman.detail');
        Route::put('/validasi-peminjaman/{peminjaman}/verify', [ValidasiPeminjamanController::class, 'verify'])->name('petugas.validasi-peminjaman.verify');
        Route::put('/validasi-peminjaman/{peminjaman}/reject', [ValidasiPeminjamanController::class, 'reject'])->name('petugas.validasi-peminjaman.reject');

        // Manajemen data peminjaman
        Route::get('/data-peminjaman', [DataPeminjamanController::class, 'index'])->name('petugas.data-peminjaman.index');
        Route::put('/data-peminjaman/{peminjaman}/konfirmasi', [DataPeminjamanController::class, 'konfirmasi'])->name('petugas.data-peminjaman.konfirmasi');
        Route::post('/petugas/peminjaman/{peminjaman}/berikan-sanksi',
    [DataPeminjamanController::class, 'berikanSanksi'])
    ->name('petugas.peminjaman.berikan-sanksi');

        // Manajemen data ulasan
        Route::get('/data-ulasan', [PetugasDataUlasanController::class, 'index'])->name('petugas.data-ulasan.index');
        Route::delete('/data-ulasan/destroy/{ulasan}', [PetugasDataUlasanController::class, 'destroy'])->name('petugas.data-ulasan.destroy');
        Route::get('/data-ulasan/export', [PetugasDataUlasanController::class, 'export'])
    ->name('petugas.data-ulasan.export');

        // Manajemen Riwayat Peminjaman
        Route::get('/riwayat-peminjaman', [PetugasRiwayatPeminjamanController::class, 'index'])->name('petugas.riwayat-peminjaman.index');
        Route::get('/riwayat-peminjaman/export', [PetugasRiwayatPeminjamanController::class, 'export'])->name('petugas.riwayat-peminjaman.export');

         // Manajemen profil petugas
        Route::get('/profil', [PetugasProfilController::class, 'index'])->name('profil-petugas.index');
        Route::get('/profil/edit', [PetugasProfilController::class, 'edit'])->name('profil-petugas.edit');
        Route::put('/profil/update', [PetugasProfilController::class, 'update'])->name('profil-petugas.update');
    });


// =======================


// PEMINJAM ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:peminjam'])
    ->prefix('peminjam')
    ->group(function () {

       Route::get('/dashboard', [DashboardController::class, 'index'])->name('peminjam.dashboard');

        // Manajemen Buku
        Route::get('/katalog-buku', [BukuController::class, 'index'])->name('peminjam.buku.index');
        Route::get('/buku/{buku}', [BukuController::class, 'detail'])->name('peminjam.buku.detail');
        Route::post('/buku/{id}/favorit',[BukuController::class, 'toggleFavorit'])->name('peminjam.buku.favorit');


        // Manajemen Peminjaman
        Route::get('/form-peminjaman/{buku}', [PeminjamanBukuController::class, 'form'])->name('peminjam.form-peminjaman');
        Route::post('/form-peminjaman', [PeminjamanBukuController::class, 'store'])->name('peminjam.form-peminjaman.store');

        // peminjaman
        // Route::get('/peminjaman/{buku}', [PeminjamanController::class, 'create'])->name('peminjam.peminjaman.create');
        // Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjam.peminjaman.store');

        // Manajemen riwayat peminjaman
        Route::get('/riwayat-peminjaman', [PeminjamRiwayatPeminjamanController::class, 'index'])->name('peminjam.riwayat-peminjaman.index');
        Route::get('/riwayat-peminjaman/detail/{peminjaman}', [PeminjamRiwayatPeminjamanController::class, 'detail'])->name('peminjam.riwayat-peminjaman.detail');
        Route::delete('/riwayat-peminjaman/{riwayat}', [PeminjamRiwayatPeminjamanController::class, 'destroy'])->name('peminjam.riwayat-peminjaman.destroy');


        // Manajemen Ulasan
        Route::post('/ulasan', [UlasanController::class, 'store'])->name('peminjam.ulasan.store');

        // Manajemen profil peminjam
        Route::get('/profil', [ProfilController::class, 'index'])->name('profil-peminjam.index');
        Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil-peminjam.edit');
        Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil-peminjam.update');
    });
