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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->unsignedBigInteger('id_pengguna');
            
            $table->string('judul', 100);
            $table->text('pesan');
            $table->enum('status_baca', ['Belum Dibaca', 'Dibaca'])->default('Belum Dibaca');
            $table->dateTime('tanggal_kirim');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
