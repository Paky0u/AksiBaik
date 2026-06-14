<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KegiatanSosial;
use App\Models\Donasi;
use App\Models\PendaftaranRelawan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data role pengguna yang sedang login
        $role = auth()->user()->role;

        // Arahkan ke file Blade sesuai role-nya dengan data pendukung
        if ($role === 'admin') {
            $totalRelawan = User::where('role', 'relawan')->count();
            $totalKegiatan = KegiatanSosial::count();
            
            // Mengambil jumlah nominal donasi dengan status 'Diterima'
            $totalDonasi = Donasi::where('status_donasi', 'Diterima')
                ->where('jenis_donasi', 'Uang')
                ->sum('nominal_donasi');

            return view('admin.dashboard', compact('totalRelawan', 'totalKegiatan', 'totalDonasi'));
        } elseif ($role === 'koordinator') {
            // Mengambil semua kegiatan sosial milik yayasan beserta kategorinya
            $kegiatanSosials = KegiatanSosial::with(['kategori', 'koordinator'])
                ->orderBy('id_kegiatan', 'desc')
                ->get();

            return view('koordinator.dashboard', compact('kegiatanSosials'));
        } else {
            // Mengambil riwayat pendaftaran kegiatan milik relawan yang login
            $riwayatKegiatan = PendaftaranRelawan::where('id_pengguna', auth()->id())
                ->with(['kegiatanSosial.kategori', 'kegiatanSosial.koordinator'])
                ->orderBy('id_pendaftaran', 'desc')
                ->get();

            return view('relawan.dashboard', compact('riwayatKegiatan'));
        }
    }
}
