<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriKegiatan;

class KategoriKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Bencana Alam',
                'deskripsi' => 'Penyaluran logistik, evakuasi, dan bantuan darurat bagi wilayah terdampak bencana alam.',
            ],
            [
                'nama_kategori' => 'Pendidikan',
                'deskripsi' => 'Kegiatan pengajaran, pembagian alat sekolah, dan peningkatan kapasitas ilmu pengetahuan anak-anak.',
            ],
            [
                'nama_kategori' => 'Kesehatan',
                'deskripsi' => 'Kegiatan pelayanan medis gratis, posyandu, pencegahan penyakit, dan penyuluhan kesehatan.',
            ],
            [
                'nama_kategori' => 'Lingkungan',
                'deskripsi' => 'Aksi penanaman pohon, pembersihan pantai, kampanye pelestarian alam, dan pengelolaan sampah.',
            ],
            [
                'nama_kategori' => 'Kemanusiaan',
                'deskripsi' => 'Kunjungan panti asuhan, pembagian sembako untuk kaum dhuafa, dan aksi sosial kemanusiaan lainnya.',
            ],
        ];

        foreach ($categories as $cat) {
            KategoriKegiatan::updateOrCreate(
                ['nama_kategori' => $cat['nama_kategori']],
                ['deskripsi' => $cat['deskripsi']]
            );
        }
    }
}
