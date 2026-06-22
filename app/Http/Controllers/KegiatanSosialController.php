<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatan;
use App\Models\KegiatanSosial;
use Illuminate\Http\Request;

class KegiatanSosialController extends Controller
{
    /**
     * Tampilkan daftar kegiatan milik koordinator yang login.
     */
    public function index()
    {
        // Ambil data kegiatan khusus milik koordinator yang sedang login
        $kegiatans = KegiatanSosial::where('id_pengguna', auth()->id())
                                    ->with('kategori') // Eager loading untuk memanggil nama kategori
                                    ->latest()
                                    ->get();

        return view('koordinator.kegiatan.index', compact('kegiatans'));
    }

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
        $validatedData['status_persetujuan'] = 'Menunggu';

        // 3. Proses upload file gambar poster jika ada
        if ($request->hasFile('poster_donasi')) {
            // Simpan gambar poster ke storage public di folder 'posters'
            $path = $request->file('poster_donasi')->store('posters', 'public');
            $validatedData['poster_donasi'] = $path;
        }

        // 4. Masukkan data ke database
        KegiatanSosial::create($validatedData);

        // 5. Kembalikan respons sukses ke halaman index kegiatan
        return redirect()->route('koordinator.kegiatan.index')->with('success', 'Kegiatan sosial baru berhasil dibuat dan dipublikasikan!');
    }

    /**
     * Tampilkan form edit kegiatan sosial.
     */
    public function edit($id)
    {
        $kegiatan = KegiatanSosial::where('id_kegiatan', $id)->where('id_pengguna', auth()->id())->firstOrFail();
        $categories = KategoriKegiatan::orderBy('nama_kategori', 'asc')->get();
        return view('koordinator.kegiatan.edit', compact('kegiatan', 'categories'));
    }

    /**
     * Update data kegiatan sosial di database.
     */
    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanSosial::where('id_kegiatan', $id)->where('id_pengguna', auth()->id())->firstOrFail();

        // Keamanan: Pastikan hanya pembuat kegiatan yang bisa meng-update
        if ($kegiatan->id_pengguna !== auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk memperbarui kegiatan ini.');
        }

        // 1. Validasi Input Data Form
        $validatedData = $request->validate([
            'judul_kegiatan' => 'required|string|max:150',
            'id_kategori' => 'required|exists:kategori_kegiatans,id_kategori',
            'judul_kegiatan' => 'required|string|max:150',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:150',
            'tanggal_kegiatan' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kuota_relawan' => 'required|integer|min:1',
            'target_donasi' => 'nullable|numeric|min:0',
            'poster_donasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_kegiatan' => 'required|in:Aktif,Selesai,Dibatalkan',
            'dokumentasi_foto' => 'nullable|array',
            'dokumentasi_foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ], [
            'id_kategori.required' => 'Kategori kegiatan wajib dipilih.',
            'id_kategori.exists' => 'Kategori kegiatan tidak valid.',
            'judul_kegiatan.required' => 'Judul kegiatan wajib diisi.',
            'judul_kegiatan.max' => 'Judul kegiatan maksimal 150 karakter.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'lokasi.max' => 'Lokasi kegiatan maksimal 150 karakter.',
            'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
            'waktu_mulai.required' => 'Waktu mulai wajib diisi.',
            'waktu_selesai.required' => 'Waktu selesai wajib diisi.',
            'kuota_relawan.required' => 'Kuota relawan wajib diisi.',
            'kuota_relawan.min' => 'Kuota relawan minimal 1 orang.',
            'target_donasi.numeric' => 'Target donasi harus berupa angka.',
            'target_donasi.min' => 'Target donasi tidak boleh kurang dari 0.',
            'poster_donasi.image' => 'Poster harus berupa file gambar.',
            'poster_donasi.max' => 'Ukuran gambar poster maksimal 2MB.',
            'dokumentasi_foto.array' => 'File dokumentasi tidak valid.',
            'dokumentasi_foto.*.image' => 'File dokumentasi harus berupa gambar.',
            'dokumentasi_foto.*.max' => 'Ukuran setiap dokumentasi maksimal 4MB.',
            'status_kegiatan.required' => 'Status kegiatan wajib dipilih.',
            'status_kegiatan.in' => 'Status kegiatan tidak valid.',
        ]);

        // 2. Proses upload file poster baru jika ada
        if ($request->hasFile('poster_donasi')) {
            $path = $request->file('poster_donasi')->store('posters', 'public');
            $validatedData['poster_donasi'] = $path;
        }

        // Jika status menjadi Selesai, dokumentasi_foto wajib jika sebelumnya belum ada
        if ($request->input('status_kegiatan') === 'Selesai') {
            $existingDocs = is_array($kegiatan->dokumentasi_foto) ? $kegiatan->dokumentasi_foto : ($kegiatan->dokumentasi_foto ? [$kegiatan->dokumentasi_foto] : []);
            
            if (empty($existingDocs) && !$request->hasFile('dokumentasi_foto')) {
                $request->validate(['dokumentasi_foto' => 'required|array'], ['dokumentasi_foto.required' => 'Foto dokumentasi wajib diunggah minimal 1 saat menandai kegiatan selesai.']);
            }
        }

        // Proses unggah multiple file
        if ($request->hasFile('dokumentasi_foto')) {
            $docPaths = [];
            foreach ($request->file('dokumentasi_foto') as $file) {
                $docPaths[] = $file->store('dokumentasi', 'public');
            }
            
            // Gabungkan dengan dokumentasi lama (jika ada)
            $existingDocs = is_array($kegiatan->dokumentasi_foto) ? $kegiatan->dokumentasi_foto : ($kegiatan->dokumentasi_foto ? [$kegiatan->dokumentasi_foto] : []);
            $validatedData['dokumentasi_foto'] = array_merge($existingDocs, $docPaths);
        }

        // 3. Update data di database
        $validatedData['status_persetujuan'] = 'Menunggu';
        $kegiatan->update($validatedData);
        return redirect()->route('koordinator.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui dan dikirim ulang untuk persetujuan admin!');
    }

    /**
     * Hapus kegiatan sosial dari database.
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanSosial::where('id_kegiatan', $id)->where('id_pengguna', auth()->id())->firstOrFail();
        $kegiatan->delete();
        
        return redirect()->route('koordinator.kegiatan.index')->with('success', 'Kegiatan berhasil dihapus!');
    }
}
