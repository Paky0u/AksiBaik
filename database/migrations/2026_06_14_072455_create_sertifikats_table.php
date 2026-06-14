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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id('id_sertifikat');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_kegiatan');
            
            $table->string('kode_sertifikat', 50)->unique();
            $table->string('file_sertifikat', 255);
            $table->date('tanggal_terbit');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatan_sosials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
