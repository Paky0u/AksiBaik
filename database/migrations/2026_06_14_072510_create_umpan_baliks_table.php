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
        Schema::create('umpan_baliks', function (Blueprint $table) {
            $table->id('id_umpan_balik');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_kegiatan');
            
            $table->integer('penilaian'); // Nilai 1-10
            $table->text('komentar')->nullable();
            $table->dateTime('tanggal_umpan_balik');
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
        Schema::dropIfExists('umpan_baliks');
    }
};
