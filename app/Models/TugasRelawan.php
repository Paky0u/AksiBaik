<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasRelawan extends Model
{
    protected $primaryKey = 'id_tugas';
    protected $fillable = [
        'id_kegiatan', 'id_pengguna', 'nama_tugas', 
        'deskripsi_tugas', 'status_tugas', 'batas_waktu'
    ];
}
