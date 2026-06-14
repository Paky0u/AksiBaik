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
        Schema::create('dokumentasi_kegiatans', function (Blueprint $table) {
            $table->id('id_dokumentasi');
            $table->unsignedBigInteger('id_kegiatan');
            
            $table->string('file_foto', 255);
            $table->text('deskripsi_foto')->nullable();
            $table->dateTime('tanggal_unggah');
            $table->timestamps();

            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan_sosials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_kegiatans');
    }
};
