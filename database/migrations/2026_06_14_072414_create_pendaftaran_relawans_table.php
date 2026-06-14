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
        Schema::create('pendaftaran_relawans', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->unsignedBigInteger('id_pengguna'); // Relawan yang mendaftar
            $table->unsignedBigInteger('id_kegiatan'); // Kegiatan yang diikuti
            
            $table->date('tanggal_pendaftaran');
            $table->enum('status_pendaftaran', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->enum('status_kehadiran', ['Belum Dikonfirmasi', 'Hadir', 'Tidak Hadir'])->default('Belum Dikonfirmasi');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            // Relasi Foreign Key
            $table->foreign('id_pengguna')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan_sosials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_relawans');
    }
};
