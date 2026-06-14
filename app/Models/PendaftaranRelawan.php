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
}
