<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanSosial;

class PublicController extends Controller
{
    /**
     * Tampilkan halaman depan (Landing Page) dengan 6 kegiatan terbaru.
     */
    public function index()
    {
        $kegiatans = KegiatanSosial::with(['kategori', 'koordinator'])
            ->where('status_kegiatan', 'Aktif')
            ->where('status_persetujuan', 'Disetujui')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Ambil kegiatan yang sudah selesai untuk ditampilkan sebagai dokumentasi
        // Hanya tampilkan yang sudah disetujui oleh admin
        $kegiatansSelesai = KegiatanSosial::with(['kategori', 'koordinator'])
            ->where('status_kegiatan', 'Selesai')
            ->where('status_persetujuan', 'Disetujui')
            ->whereNotNull('dokumentasi_foto')
            ->orderBy('updated_at', 'desc')
            ->take(6)
            ->get();

        return view('welcome', compact('kegiatans', 'kegiatansSelesai'));
    }

    /**
     * Tampilkan halaman detail spesifik suatu kegiatan sosial.
     */
    public function show($id)
    {
        $kegiatan = KegiatanSosial::with(['kategori', 'umpanBaliks.pengguna'])->findOrFail($id);
        
        // Sembunyikan kegiatan yang belum disetujui, kecuali bagi admin atau pembuatnya
        if ($kegiatan->status_persetujuan !== 'Disetujui') {
            $user = auth()->user();
            if (!$user || ($user->role !== 'admin' && $kegiatan->id_pengguna !== $user->id)) {
                abort(404, 'Kegiatan tidak ditemukan atau belum disetujui oleh admin.');
            }
        }

        return view('kegiatan.show', compact('kegiatan'));
    }
    /**
     * Tampilkan halaman daftar seluruh kegiatan untuk publik.
     */
    public function kegiatan(Request $request)
    {
        $search = $request->input('search');
        $kategoriId = $request->input('kategori_id');

        $query = KegiatanSosial::with(['kategori', 'koordinator'])
            ->where('status_kegiatan', 'Aktif')
            ->where('status_persetujuan', 'Disetujui');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('judul_kegiatan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if (!empty($kategoriId)) {
            $query->where('id_kategori', $kategoriId);
        }

        $kegiatans = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();
        
        $semuaKategori = \App\Models\KategoriKegiatan::all();

        return view('kegiatan.index', compact('kegiatans', 'semuaKategori', 'search', 'kategoriId'));
    }
}
