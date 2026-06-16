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
        Schema::table('kegiatan_sosials', function (Blueprint $table) {
            $table->enum('status_persetujuan', ['Menunggu', 'Disetujui', 'Ditolak'])
                  ->default('Menunggu')
                  ->after('status_kegiatan');
        });

        // Update kegiatan lama agar otomatis disetujui (agar tidak hilang dari publik)
        \Illuminate\Support\Facades\DB::table('kegiatan_sosials')->update(['status_persetujuan' => 'Disetujui']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatan_sosials', function (Blueprint $table) {
            $table->dropColumn('status_persetujuan');
        });
    }
};
