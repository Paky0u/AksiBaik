<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatan;
use App\Models\KegiatanSosial;
use Illuminate\Http\Request;

class KegiatanSosialController extends Controller
{
    /**
     * Tampilkan formulir pembuatan kegiatan sosial baru.
     */
    public function create()
    {
        // Ambil semua kategori kegiatan untuk dropdown pilihan di form
        $categories = KategoriKegiatan::orderBy('nama_kategori', 'asc')->get();

        return view('koordinator.kegiatan.create', compact('categories'));
    }

    /**
     * Simpan data kegiatan sosial baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Data Form secara ketat
        $validatedData = $request->validate([
            'id_kategori' => 'required|exists:kategori_kegiatans,id_kategori',
            'judul_kegiatan' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kuota_relawan' => 'required|integer|min:1',
            'target_donasi' => 'nullable|numeric|min:0',
            'poster_donasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maks 2MB
        ], [
            'id_kategori.required' => 'Kategori kegiatan wajib dipilih.',
            'id_kategori.exists' => 'Kategori kegiatan tidak valid.',
            'judul_kegiatan.required' => 'Judul kegiatan wajib diisi.',
            'judul_kegiatan.max' => 'Judul kegiatan maksimal 150 karakter.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'lokasi.max' => 'Lokasi kegiatan maksimal 150 karakter.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
            'tanggal_kegiatan.after_or_equal' => 'Tanggal kegiatan tidak boleh di masa lampau.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'kuota_relawan.required' => 'Kuota relawan wajib diisi.',
            'kuota_relawan.min' => 'Kuota relawan minimal 1 orang.',
            'target_donasi.numeric' => 'Target donasi harus berupa angka.',
            'target_donasi.min' => 'Target donasi tidak boleh kurang dari 0.',
            'poster_donasi.image' => 'Poster harus berupa file gambar.',
            'poster_donasi.max' => 'Ukuran gambar poster maksimal 2MB.',
        ]);

        // 2. Hubungkan kegiatan dengan Koordinator yang sedang login
        $validatedData['id_pengguna'] = auth()->id();
        $validatedData['status_kegiatan'] = 'Aktif';

        // 3. Proses upload file gambar poster jika ada
        if ($request->hasFile('poster_donasi')) {
            // Simpan gambar poster ke storage public di folder 'posters'
            $path = $request->file('poster_donasi')->store('posters', 'public');
            $validatedData['poster_donasi'] = $path;
        }

        // 4. Masukkan data ke database
        KegiatanSosial::create($validatedData);

        // 5. Kembalikan respons sukses ke halaman dashboard dengan pesan alert
        return redirect()->route('dashboard')->with('success', 'Kegiatan sosial baru berhasil dibuat dan dipublikasikan!');
    }
}
