<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranRelawan;
use App\Models\KegiatanSosial;

class ManajemenRelawanController extends Controller
{
    /**
     * Menampilkan daftar pendaftar untuk kegiatan milik koordinator.
     */
    public function index()
    {
        // Ambil ID koordinator yang sedang login
        $koordinator_id = auth()->id();

        // Ambil data pendaftaran yang kegiatan_sosial-nya dimiliki oleh koordinator ini
        $pendaftarans = PendaftaranRelawan::whereHas('kegiatanSosial', function ($query) use ($koordinator_id) {
            $query->where('id_pengguna', $koordinator_id);
        })
        ->with(['relawan', 'kegiatanSosial']) // Eager load relasi relawan dan kegiatannya
        ->orderBy('id_pendaftaran', 'desc')
        ->get();

        return view('koordinator.absensi.index', compact('pendaftarans'));
    }

    /**
     * Memperbarui status pendaftaran dan kehadiran relawan.
     */
    public function updateStatus(Request $request, $id_pendaftaran)
    {
        // Validasi input form (status pendaftaran & kehadiran)
        $validated = $request->validate([
            'status_pendaftaran' => 'required|in:Pending,Approved,Rejected',
            'status_kehadiran' => 'nullable|in:Belum Dikonfirmasi,Hadir,Tidak Hadir'
        ]);

        // Cari pendaftaran
        $pendaftaran = PendaftaranRelawan::findOrFail($id_pendaftaran);

        // Keamanan tambahan: pastikan koordinator yang login memiliki kegiatan ini
        if ($pendaftaran->kegiatanSosial->id_pengguna !== auth()->id()) {
            abort(403, 'Anda tidak berhak mengubah data ini.');
        }

        // Update atribut
        $pendaftaran->status_pendaftaran = $validated['status_pendaftaran'];
        
        if (isset($validated['status_kehadiran'])) {
            $pendaftaran->status_kehadiran = $validated['status_kehadiran'];
        }

        $pendaftaran->save();

        return redirect()->route('koordinator.absensi.index')->with('success', 'Status pendaftar berhasil diperbarui.');
    }
}
