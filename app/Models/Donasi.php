<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $primaryKey = 'id_donasi';
protected $fillable = ['id_pengguna', 'id_kegiatan', 'jenis_donasi', 'nominal_donasi', 'deskripsi_barang', 'jumlah_barang', 'bukti_donasi', 'tanggal_donasi', 'status_donasi'];
}
