<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranRelawan;
use App\Models\KegiatanSosial;

class PendaftaranRelawanController extends Controller
{
    /**
     * Simpan data pendaftaran relawan ke database.
     */
    public function store(Request $request, $id_kegiatan)
    {
        $kegiatan = KegiatanSosial::findOrFail($id_kegiatan);
        $user_id = auth()->id();

        // 1. Cek apakah kegiatan masih aktif
        if ($kegiatan->status_kegiatan !== 'Aktif') {
            return redirect()->back()->with('error', 'Pendaftaran untuk kegiatan ini sudah ditutup.');
        }

        // 2. Cek apakah relawan sudah mendaftar di kegiatan ini
        $alreadyRegistered = PendaftaranRelawan::where('id_pengguna', $user_id)
            ->where('id_kegiatan', $id_kegiatan)
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->back()->with('error', 'Anda sudah mendaftar untuk kegiatan ini.');
        }

        // 3. Simpan data pendaftaran dengan status Pending
        PendaftaranRelawan::create([
            'id_pengguna' => $user_id,
            'id_kegiatan' => $id_kegiatan,
            'tanggal_pendaftaran' => now(),
            'status_pendaftaran' => 'Pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Berhasil mendaftar! Menunggu persetujuan koordinator.');
    }

    /**
     * Menampilkan sertifikat relawan jika status kehadiran adalah 'Hadir'.
     */
    public function sertifikat($id_pendaftaran)
    {
        $pendaftaran = PendaftaranRelawan::with(['kegiatanSosial.kategori', 'relawan'])->findOrFail($id_pendaftaran);

        // Hanya relawan yang login dan berstatus Hadir yang bisa akses
        if ($pendaftaran->id_pengguna !== auth()->id() || $pendaftaran->status_kehadiran !== 'Hadir') {
            return redirect()->route('dashboard')->with('error', 'Sertifikat tidak tersedia atau Anda tidak memiliki akses.');
        }

        return view('relawan.sertifikat', compact('pendaftaran'));
    }
}
