<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranRelawan extends Model
{
    protected $primaryKey = 'id_pendaftaran';
    protected $fillable = [
        'id_pengguna', 'id_kegiatan', 'tanggal_pendaftaran', 
        'status_pendaftaran', 'status_kehadiran', 'catatan_admin'
    ];

    /**
     * Relasi ke Model KegiatanSosial
     */
    public function kegiatanSosial()
    {
        return $this->belongsTo(KegiatanSosial::class, 'id_kegiatan', 'id_kegiatan');
    }

    /**
     * Relasi ke Model User (Relawan)
     */
    public function relawan()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }
}
