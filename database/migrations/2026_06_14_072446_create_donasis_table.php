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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id('id_donasi');
            $table->unsignedBigInteger('id_pengguna')->nullable(); // Boleh kosong jika anonim
            $table->unsignedBigInteger('id_kegiatan');
            
            $table->enum('jenis_donasi', ['Uang', 'Barang']);
            $table->decimal('nominal_donasi', 15, 2)->nullable();
            $table->text('deskripsi_barang')->nullable();
            $table->integer('jumlah_barang')->nullable();
            $table->string('bukti_donasi', 255)->nullable();
            $table->dateTime('tanggal_donasi');
            $table->enum('status_donasi', ['Menunggu Verifikasi', 'Diterima', 'Ditolak'])->default('Menunggu Verifikasi');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan_sosials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
