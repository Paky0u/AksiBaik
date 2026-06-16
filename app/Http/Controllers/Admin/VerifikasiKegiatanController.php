<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanSosial;

class VerifikasiKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = KegiatanSosial::with(['koordinator', 'kategori']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status_persetujuan', $request->status);
        }

        $kegiatans = $query->orderBy('created_at', 'desc')->get();

        return view('admin.verifikasi_kegiatan.index', compact('kegiatans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_persetujuan' => 'required|in:Disetujui,Ditolak,Menunggu',
        ]);

        $kegiatan = KegiatanSosial::findOrFail($id);
        $kegiatan->update([
            'status_persetujuan' => $request->status_persetujuan
        ]);

        $pesan = $request->status_persetujuan == 'Disetujui' 
            ? 'Kegiatan berhasil disetujui dan sekarang tampil di publik.' 
            : 'Kegiatan berhasil ditolak.';

        return redirect()->back()->with('success', $pesan);
    }
}
