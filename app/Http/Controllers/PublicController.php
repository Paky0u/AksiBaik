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

        return view('welcome', compact('kegiatans'));
    }

    /**
     * Tampilkan halaman detail spesifik suatu kegiatan sosial.
     */
    public function show($id)
    {
        $kegiatan = KegiatanSosial::with('kategori')->findOrFail($id);
        return view('kegiatan.show', compact('kegiatan'));
    }
}
