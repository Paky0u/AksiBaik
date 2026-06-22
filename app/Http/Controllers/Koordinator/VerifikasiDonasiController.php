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

    public function export($id_kegiatan)
    {
        $kegiatan = KegiatanSosial::findOrFail($id_kegiatan);
        
        // Pastikan kegiatan ini milik koordinator yang sedang login
        if ($kegiatan->id_pengguna !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $donasis = Donasi::where('id_kegiatan', $id_kegiatan)
            ->with(['donatur'])
            ->orderBy('created_at', 'desc')
            ->get();

        $fileName = 'Laporan_Donasi_' . \Illuminate\Support\Str::slug($kegiatan->judul_kegiatan) . '_' . date('Y-m-d') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Tanggal', 'Nama Donatur', 'Jenis Donasi', 'Nominal (Rp)', 'Barang', 'Status'];

        $callback = function() use($donasis, $columns) {
            $file = fopen('php://output', 'w');
            
            // Tambahkan BOM untuk Excel UTF-8
            fputs($file, "\xEF\xBB\xBF");
            
            fputcsv($file, $columns, ';'); // Menggunakan titik koma agar Excel bahasa Indonesia mudah membacanya

            foreach ($donasis as $donasi) {
                $row['Tanggal']  = \Carbon\Carbon::parse($donasi->created_at)->format('d-m-Y H:i');
                $row['Nama Donatur']    = $donasi->nama_samaran ?? ($donasi->donatur->name ?? 'Anonim');
                $row['Jenis Donasi']  = $donasi->jenis_donasi;
                $row['Nominal (Rp)']  = $donasi->jenis_donasi === 'Uang' ? $donasi->nominal_donasi : 0;
                $row['Barang']  = $donasi->jenis_donasi === 'Barang' ? $donasi->jumlah_barang . 'x ' . $donasi->deskripsi_barang : '-';
                $row['Status']  = $donasi->status_donasi;

                fputcsv($file, array($row['Tanggal'], $row['Nama Donatur'], $row['Jenis Donasi'], $row['Nominal (Rp)'], $row['Barang'], $row['Status']), ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
