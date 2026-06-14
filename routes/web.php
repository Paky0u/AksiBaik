<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', function () {
    return view('welcome'); // Halaman Landing Page AksiBaik
})->name('home');

Route::get('/kegiatan', function () {
    return 'Ini halaman daftar kegiatan untuk publik/tamu';
})->name('kegiatan.publik');

Route::get('/donasi', function () {
    return 'Ini halaman form donasi untuk publik/tamu';
})->name('donasi.publik');


// ==========================================
// 2. RUTE TERPROTEKSI (Wajib Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama yang sudah dinamis
    Route::get('/dashboard', 
    [\App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard');

    // Profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------------------------------
    // A. KELOMPOK RUTE ADMIN
    // ------------------------------------------
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/kategori', function () { return 'Halaman Kelola Kategori (Khusus Admin)'; })->name('kategori');
        Route::get('/pengguna', function () { return 'Halaman Kelola Pengguna (Khusus Admin)'; })->name('pengguna');
        Route::get('/verifikasi-kegiatan', function () { return 'Halaman Approval Kegiatan'; })->name('verifikasi.kegiatan');
    });

    // ------------------------------------------
    // B. KELOMPOK RUTE KOORDINATOR (YAYASAN)
    // ------------------------------------------
    Route::middleware(['role:koordinator'])->prefix('koordinator')->name('koordinator.')->group(function () {
        
        // Rute CRUD Kegiatan Sosial (Lengkap)
        Route::get('/kegiatan', [\App\Http\Controllers\KegiatanSosialController::class, 'index'])->name('kegiatan.index');
        Route::get('/kegiatan/create', [\App\Http\Controllers\KegiatanSosialController::class, 'create'])->name('kegiatan.create');
        Route::post('/kegiatan', [\App\Http\Controllers\KegiatanSosialController::class, 'store'])->name('kegiatan.store');
        Route::get('/kegiatan/{id}/edit', [\App\Http\Controllers\KegiatanSosialController::class, 'edit'])->name('kegiatan.edit');
        Route::put('/kegiatan/{id}', [\App\Http\Controllers\KegiatanSosialController::class, 'update'])->name('kegiatan.update');
        Route::delete('/kegiatan/{id}', [\App\Http\Controllers\KegiatanSosialController::class, 'destroy'])->name('kegiatan.destroy');

        Route::get('/absensi', function () { return 'Halaman Absensi Relawan di Hari H'; })->name('absensi');
        Route::get('/verifikasi-donasi', function () { return 'Halaman Cek Barang Donasi'; })->name('donasi');
    });

    // ------------------------------------------
    // C. KELOMPOK RUTE RELAWAN
    // ------------------------------------------
    Route::middleware(['role:relawan'])->prefix('relawan')->name('relawan.')->group(function () {
        Route::get('/riwayat-kegiatan', function () { return 'Halaman Riwayat Acara Saya'; })->name('riwayat');
        Route::get('/sertifikat', function () { return 'Halaman Unduh Sertifikat'; })->name('sertifikat');
        Route::get('/feedback', function () { return 'Halaman Beri Penilaian'; })->name('feedback');
    });

});

// Memanggil rute otentikasi bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';