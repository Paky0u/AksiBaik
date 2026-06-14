<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $primaryKey = 'id_sertifikat';
protected $fillable = ['id_pengguna', 'id_kegiatan', 'kode_sertifikat', 'file_sertifikat', 'tanggal_terbit'];
}
