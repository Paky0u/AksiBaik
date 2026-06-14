<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    protected $primaryKey = 'id_dokumentasi';
protected $fillable = ['id_kegiatan', 'file_foto', 'deskripsi_foto', 'tanggal_unggah'];
}
