<?php

namespace App\Http\Controllers\Koordinator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanSosial;
use App\Models\Donasi;

class VerifikasiDonasiController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        
        // Ambil ID kegiatan yang dimiliki oleh koordinator ini
        $kegiatanIds = KegiatanSosial::where('id_pengguna', $user_id)->pluck('id_kegiatan');
        
        // Ambil donasi untuk kegiatan-kegiatan tersebut
        $donasis = Donasi::whereIn('id_kegiatan', $kegiatanIds)
            ->with(['kegiatanSosial', 'donatur'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('id_kegiatan');
            
        return view('koordinator.donasi.index', compact('donasis'));
    }

    public function updateStatus(Request $request, $id_donasi)
    {
        $request->validate([
            'status_donasi' => 'required|in:Diterima,Ditolak'
        ]);

        $donasi = Donasi::findOrFail($id_donasi);
        
        // Pastikan donasi ini milik kegiatan yang dibuat oleh koordinator ini
        $kegiatan = KegiatanSosial::findOrFail($donasi->id_kegiatan);
        if ($kegiatan->id_pengguna !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $donasi->update([
            'status_donasi' => $request->status_donasi
        ]);

        return back()->with('success', 'Status donasi berhasil diperbarui.');
    }
}
