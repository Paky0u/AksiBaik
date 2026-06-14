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
        Schema::create('tugas_relawans', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->unsignedBigInteger('id_kegiatan'); // Tugas ini untuk acara apa
            
            // id_pengguna di-set nullable() karena saat tugas baru dibuat Koordinator, 
            // belum tentu ada relawan yang langsung mengambilnya.
            $table->unsignedBigInteger('id_pengguna')->nullable(); 
            
            $table->string('nama_tugas', 100);
            $table->text('deskripsi_tugas');
            $table->enum('status_tugas', ['Belum Dimulai', 'Dalam Proses', 'Selesai'])->default('Belum Dimulai');
            $table->dateTime('batas_waktu')->nullable();
            $table->timestamps();

            // Relasi Foreign Key
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan_sosials')->onDelete('cascade');
            $table->foreign('id_pengguna')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_relawans');
    }
};
