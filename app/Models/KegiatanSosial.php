<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanSosial extends Model
{
    // Tentukan primary key yang kita custom
    protected $primaryKey = 'id_kegiatan';

    // Daftarkan semua kolom yang boleh diisi melalui form (Mass Assignment)
    protected $fillable = [
        'id_pengguna',
        'id_kategori',
        'judul_kegiatan',
        'deskripsi',
        'lokasi',
        'tanggal_kegiatan',
        'waktu_mulai',
        'waktu_selesai',
        'kuota_relawan',
        'target_donasi',
        'poster_donasi',
        'dokumentasi_foto',
        'status_kegiatan',
        'status_persetujuan',
    ];

    /**
     * Relasi ke Model User (Koordinator)
     * Satu kegiatan dimiliki oleh satu pengguna (koordinator)
     */
    public function koordinator()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }

    /**
     * Relasi ke Model KategoriKegiatan
     * Satu kegiatan memiliki satu kategori
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriKegiatan::class, 'id_kategori', 'id_kategori');
    }
}
