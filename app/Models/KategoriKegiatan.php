<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKegiatan extends Model
{
    protected $primaryKey = 'id_kategori';
    
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];
}
