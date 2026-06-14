<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatan_sosials', function (Blueprint $table) {
        $table->id('id_kegiatan');
        
        // 1. Siapkan kolom untuk Foreign Key
        $table->unsignedBigInteger('id_pengguna'); // Koordinator yang membuat
        $table->unsignedBigInteger('id_kategori'); // Kategori acara

        // 2. Kolom data utama
        $table->string('judul_kegiatan', 150);
        $table->text('deskripsi');
        $table->string('lokasi', 150);
        $table->date('tanggal_kegiatan');
        $table->time('waktu_mulai');
        $table->time('waktu_selesai');
        $table->integer('kuota_relawan');
        $table->decimal('target_donasi', 15, 2)->nullable();
        $table->string('poster_donasi', 255)->nullable();
        $table->enum('status_kegiatan', ['Aktif', 'Selesai', 'Dibatalkan'])->default('Aktif');
        $table->timestamps();

        // 3. Deklarasi Relasi Foreign Key
        $table->foreign('id_pengguna')
              ->references('id')->on('users')
              ->onDelete('cascade'); // Jika user dihapus, kegiatannya ikut terhapus
              
        $table->foreign('id_kategori')
              ->references('id_kategori')->on('kategori_kegiatans')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_sosials');
    }
};
