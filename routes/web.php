<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', [\App\Http\Controllers\PublicController::class, 'index'])->name('home');

Route::get('/kegiatan', [\App\Http\Controllers\PublicController::class, 'kegiatan'])->name('kegiatan.publik');


Route::get('/kegiatan/{id}', [\App\Http\Controllers\PublicController::class, 'show'])->name('kegiatan.show');

Route::get('/kegiatan/{id}/donasi', [\App\Http\Controllers\DonasiController::class, 'create'])->name('donasi.create');
Route::post('/kegiatan/{id}/donasi', [\App\Http\Controllers\DonasiController::class, 'store'])->name('donasi.store');
Route::post('/donasi/{id}/midtrans/finish', [\App\Http\Controllers\DonasiController::class, 'midtransFinish'])->name('donasi.midtrans.finish');

// Webhook Midtrans (Bypasses CSRF di bootstrap/app.php)
Route::post('/midtrans/webhook', [\App\Http\Controllers\MidtransWebhookController::class, 'handle'])->name('donasi.midtrans.webhook');


// ==========================================
// 2. RUTE TERPROTEKSI (Wajib Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama yang sudah dinamis
    Route::get('/dashboard', 
    [\App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard');

    // Riwayat Donasi untuk semua user login
    Route::get('/riwayat-donasi', [\App\Http\Controllers\DonasiController::class, 'riwayat'])->name('donasi.riwayat');

    // Profile bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ------------------------------------------
    // A. KELOMPOK RUTE ADMIN
    // ------------------------------------------
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('kategori', \App\Http\Controllers\Admin\KategoriKegiatanController::class)->except(['show']);
        Route::resource('pengguna', \App\Http\Controllers\Admin\PenggunaController::class)->except(['show', 'create', 'store']);
        Route::get('/verifikasi-kegiatan', [\App\Http\Controllers\Admin\VerifikasiKegiatanController::class, 'index'])->name('verifikasi.kegiatan.index');
        Route::put('/verifikasi-kegiatan/{id}', [\App\Http\Controllers\Admin\VerifikasiKegiatanController::class, 'updateStatus'])->name('verifikasi.kegiatan.update');
        Route::delete('/umpan-balik/{id}', [\App\Http\Controllers\Admin\UmpanBalikController::class, 'destroy'])->name('umpan_balik.destroy');
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

        Route::get('/absensi', [\App\Http\Controllers\ManajemenRelawanController::class, 'index'])->name('absensi.index');
        Route::put('/absensi/{id}', [\App\Http\Controllers\ManajemenRelawanController::class, 'updateStatus'])->name('absensi.update');
        
        Route::get('/verifikasi-donasi', [\App\Http\Controllers\Koordinator\VerifikasiDonasiController::class, 'index'])->name('donasi.index');
        Route::put('/verifikasi-donasi/{id}', [\App\Http\Controllers\Koordinator\VerifikasiDonasiController::class, 'updateStatus'])->name('donasi.update');
        Route::get('/kegiatan/{id}/export-donasi', [\App\Http\Controllers\Koordinator\VerifikasiDonasiController::class, 'export'])->name('donasi.export');
    });

    // ------------------------------------------
    // C. KELOMPOK RUTE RELAWAN
    // ------------------------------------------
    Route::middleware(['role:relawan'])->prefix('relawan')->name('relawan.')->group(function () {
        Route::get('/riwayat-kegiatan', [\App\Http\Controllers\PendaftaranRelawanController::class, 'riwayat'])->name('riwayat');
        Route::get('/sertifikat/{id_pendaftaran}', [\App\Http\Controllers\PendaftaranRelawanController::class, 'sertifikat'])->name('sertifikat');
        Route::get('/feedback/{id_kegiatan}', [\App\Http\Controllers\PendaftaranRelawanController::class, 'feedback'])->name('feedback');
        Route::post('/feedback/{id_kegiatan}', [\App\Http\Controllers\PendaftaranRelawanController::class, 'storeFeedback'])->name('feedback.store');
        
        // Rute Pendaftaran Relawan
        Route::post('/daftar/{id_kegiatan}', [\App\Http\Controllers\PendaftaranRelawanController::class, 'store'])->name('daftar');
    });

});

// Memanggil rute otentikasi bawaan Breeze (Login, Register, Logout)
require __DIR__.'/auth.php';