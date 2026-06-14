<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $primaryKey = 'id_notifikasi';
protected $fillable = ['id_pengguna', 'judul', 'pesan', 'status_baca', 'tanggal_kirim'];
}
