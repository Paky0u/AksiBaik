<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriKegiatan;
use App\Models\KegiatanSosial;
use App\Models\PendaftaranRelawan;
use App\Models\Donasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Jalankan UserSeeder jika user belum di-seed
        if (User::count() === 0) {
            $this->call([
                UserSeeder::class,
            ]);
        }

        // 2. Seed KategoriKegiatan dengan memanggil KategoriKegiatanSeeder
        $this->call([
            KategoriKegiatanSeeder::class,
        ]);

        // Ambil kategori untuk referensi seeding kegiatan
        $kategoriPendidikan = KategoriKegiatan::where('nama_kategori', 'Pendidikan')->first();
        $kategoriBencana = KategoriKegiatan::where('nama_kategori', 'Bencana Alam')->first();
        $kategoriLingkungan = KategoriKegiatan::where('nama_kategori', 'Lingkungan')->first();

        // Cari ID Koordinator (Biasanya ID = 2 dari UserSeeder)
        $koordinator = User::where('role', 'koordinator')->first();
        $idKoordinator = $koordinator ? $koordinator->id : 2;

        // Cari ID Relawan (Biasanya ID = 3 dari UserSeeder)
        $relawan = User::where('role', 'relawan')->first();
        $idRelawan = $relawan ? $relawan->id : 3;

        // 3. Seed KegiatanSosial jika kosong
        if (KegiatanSosial::count() === 0 && $kategoriPendidikan && $kategoriBencana && $kategoriLingkungan) {
            // Kegiatan 1 (Aktif)
            $kegiatan1 = KegiatanSosial::create([
                'id_pengguna' => $idKoordinator,
                'id_kategori' => $kategoriLingkungan->id_kategori,
                'judul_kegiatan' => 'Aksi Bersih Pantai Ancol',
                'deskripsi' => 'Membantu membersihkan sampah plastik di pesisir Pantai Ancol bersama komunitas peduli laut setempat. Kami mengundang seluruh relawan untuk ikut serta menjaga ekosistem pantai dari polusi plastik.',
                'lokasi' => 'Pantai Ancol, Jakarta Utara',
                'tanggal_kegiatan' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'waktu_mulai' => '07:00:00',
                'waktu_selesai' => '11:00:00',
                'kuota_relawan' => 50,
                'target_donasi' => 5000000.00,
                'status_kegiatan' => 'Aktif',
            ]);

            // Kegiatan 2 (Aktif)
            $kegiatan2 = KegiatanSosial::create([
                'id_pengguna' => $idKoordinator,
                'id_kategori' => $kategoriPendidikan->id_kategori,
                'judul_kegiatan' => 'Mengajar Mengaji & Berhitung Anak Jalanan',
                'deskripsi' => 'Program pengabdian masyarakat untuk memberikan bimbingan belajar, pendidikan akhlak, membaca, menulis, dan berhitung dasar untuk anak-anak jalanan di kolong jembatan.',
                'lokasi' => 'Kolong Jembatan Grogol, Jakarta Barat',
                'tanggal_kegiatan' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'waktu_mulai' => '15:00:00',
                'waktu_selesai' => '17:30:00',
                'kuota_relawan' => 15,
                'target_donasi' => 2000000.00,
                'status_kegiatan' => 'Aktif',
            ]);

            // Kegiatan 3 (Selesai)
            $kegiatan3 = KegiatanSosial::create([
                'id_pengguna' => $idKoordinator,
                'id_kategori' => $kategoriBencana->id_kategori,
                'judul_kegiatan' => 'Bantuan Logistik Banjir Cipinang',
                'deskripsi' => 'Penyaluran bahan makanan pokok, air bersih, pakaian layak pakai, serta obat-obatan penunjang kepada korban terdampak banjir bandang di Cipinang Melayu.',
                'lokasi' => 'Cipinang Melayu, Jakarta Timur',
                'tanggal_kegiatan' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'waktu_mulai' => '08:00:00',
                'waktu_selesai' => '16:00:00',
                'kuota_relawan' => 30,
                'target_donasi' => 25000000.00,
                'status_kegiatan' => 'Selesai',
            ]);

            // 4. Seed PendaftaranRelawan jika kosong
            if (PendaftaranRelawan::count() === 0) {
                // Relawan terdaftar di Kegiatan 2 (Aktif, Approved, Belum konfirmasi kehadiran)
                PendaftaranRelawan::create([
                    'id_pengguna' => $idRelawan,
                    'id_kegiatan' => $kegiatan2->id_kegiatan,
                    'tanggal_pendaftaran' => Carbon::now()->subDays(2)->format('Y-m-d'),
                    'status_pendaftaran' => 'Approved',
                    'status_kehadiran' => 'Belum Dikonfirmasi',
                ]);

                // Relawan terdaftar di Kegiatan 3 (Selesai, Approved, Hadir)
                PendaftaranRelawan::create([
                    'id_pengguna' => $idRelawan,
                    'id_kegiatan' => $kegiatan3->id_kegiatan,
                    'tanggal_pendaftaran' => Carbon::now()->subDays(12)->format('Y-m-d'),
                    'status_pendaftaran' => 'Approved',
                    'status_kehadiran' => 'Hadir',
                    'catatan_admin' => 'Relawan sangat aktif membantu proses penyaluran nasi bungkus ke posko banjir.',
                ]);
            }

            // 5. Seed Donasi jika kosong
            if (Donasi::count() === 0) {
                // Donasi 1 (Uang diterima untuk Kegiatan 3)
                Donasi::create([
                    'id_pengguna' => $idRelawan,
                    'id_kegiatan' => $kegiatan3->id_kegiatan,
                    'jenis_donasi' => 'Uang',
                    'nominal_donasi' => 500000.00,
                    'tanggal_donasi' => Carbon::now()->subDays(11),
                    'status_donasi' => 'Diterima',
                ]);

                // Donasi 2 (Uang diterima dari anonim untuk Kegiatan 1)
                Donasi::create([
                    'id_pengguna' => null,
                    'id_kegiatan' => $kegiatan1->id_kegiatan,
                    'jenis_donasi' => 'Uang',
                    'nominal_donasi' => 1500000.00,
                    'tanggal_donasi' => Carbon::now()->subDays(1),
                    'status_donasi' => 'Diterima',
                ]);

                // Donasi 3 (Barang dalam verifikasi dari Relawan untuk Kegiatan 1)
                Donasi::create([
                    'id_pengguna' => $idRelawan,
                    'id_kegiatan' => $kegiatan1->id_kegiatan,
                    'jenis_donasi' => 'Barang',
                    'deskripsi_barang' => 'Kantong Sampah Ramah Lingkungan & Sarung Tangan Karet',
                    'jumlah_barang' => 10,
                    'tanggal_donasi' => Carbon::now()->subMinutes(30),
                    'status_donasi' => 'Menunggu Verifikasi',
                ]);
            }
        }
    }
}

