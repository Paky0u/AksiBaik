<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanSosial;
use App\Models\Donasi;

class DonasiController extends Controller
{
    public function create($id_kegiatan)
    {
        $kegiatan = KegiatanSosial::findOrFail($id_kegiatan);
        return view('donasi.create', compact('kegiatan'));
    }

    public function store(Request $request, $id_kegiatan)
    {
        $request->validate([
            'jenis_donasi' => 'required|in:Uang,Barang',
            'nominal_donasi' => 'nullable|required_if:jenis_donasi,Uang|numeric|min:1000',
            'deskripsi_barang' => 'nullable|required_if:jenis_donasi,Barang|string',
            'jumlah_barang' => 'nullable|required_if:jenis_donasi,Barang|integer|min:1',
            'bukti_donasi' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $kegiatan = KegiatanSosial::findOrFail($id_kegiatan);

        $path = $request->file('bukti_donasi')->store('donasi', 'public');

        Donasi::create([
            'id_pengguna' => auth()->check() ? auth()->id() : null,
            'id_kegiatan' => $id_kegiatan,
            'jenis_donasi' => $request->jenis_donasi,
            'nominal_donasi' => $request->jenis_donasi === 'Uang' ? $request->nominal_donasi : null,
            'deskripsi_barang' => $request->jenis_donasi === 'Barang' ? $request->deskripsi_barang : null,
            'jumlah_barang' => $request->jenis_donasi === 'Barang' ? $request->jumlah_barang : null,
            'bukti_donasi' => $path,
            'tanggal_donasi' => now(),
            'status_donasi' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('kegiatan.show', $id_kegiatan)
            ->with('success', 'Terima kasih! Donasi Anda telah dicatat dan sedang menunggu verifikasi.');
    }
}
