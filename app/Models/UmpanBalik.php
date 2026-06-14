<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmpanBalik extends Model
{
    protected $primaryKey = 'id_umpan_balik';
protected $fillable = ['id_pengguna', 'id_kegiatan', 'penilaian', 'komentar', 'tanggal_umpan_balik'];
}
