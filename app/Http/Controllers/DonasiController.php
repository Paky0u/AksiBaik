<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KegiatanSosial;
use App\Models\Donasi;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;

class DonasiController extends Controller
{
    public function create($id_kegiatan)
    {
        $kegiatan = KegiatanSosial::findOrFail($id_kegiatan);
        return view('donasi.create', compact('kegiatan'));
    }

    public function store(Request $request, $id_kegiatan)
    {
        $rules = [
            'jenis_donasi' => 'required|in:Uang,Barang',
        ];

        if ($request->input('jenis_donasi') === 'Uang') {
            $rules['nominal_donasi'] = 'required|numeric|min:1000';
        } else {
            $rules['deskripsi_barang'] = 'required|string';
            $rules['jumlah_barang'] = 'required|integer|min:1';
            // bukti_donasi dihapus: tidak lagi meminta upload gambar
        }

        $request->validate($rules);

        $kegiatan = KegiatanSosial::findOrFail($id_kegiatan);

        if ($request->input('jenis_donasi') === 'Barang') {
            Donasi::create([
                'id_pengguna' => auth()->check() ? auth()->id() : null,
                'id_kegiatan' => $id_kegiatan,
                'jenis_donasi' => $request->jenis_donasi,
                'nominal_donasi' => null,
                'deskripsi_barang' => $request->deskripsi_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'bukti_donasi' => null,
                'tanggal_donasi' => now(),
                'status_donasi' => 'Menunggu Verifikasi',
            ]);

            return redirect()->route('kegiatan.show', $id_kegiatan)
                ->with('success', 'Terima kasih! Donasi barang Anda telah dicatat dan sedang menunggu verifikasi.');
        }

        // Jika jenis donasi adalah Uang -> buat record dengan status 'Pending Payment' lalu minta token Midtrans
        $nominal = (int) $request->input('nominal_donasi');

        $donasi = Donasi::create([
            'id_pengguna' => auth()->check() ? auth()->id() : null,
            'id_kegiatan' => $id_kegiatan,
            'jenis_donasi' => 'Uang',
            'nominal_donasi' => $nominal,
            'deskripsi_barang' => null,
            'jumlah_barang' => null,
            'bukti_donasi' => null,
            'tanggal_donasi' => now(),
            'status_donasi' => 'Menunggu Verifikasi',
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'DON-' . $donasi->id_donasi . '-' . time();

        $transaction = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $nominal,
            ],
            'customer_details' => [
                'first_name' => auth()->check() ? auth()->user()->name : 'Donatur',
                'email' => auth()->check() ? auth()->user()->email : null,
            ],
            'item_details' => [
                [
                    'id' => $donasi->id_donasi,
                    'price' => $nominal,
                    'quantity' => 1,
                    'name' => 'Donasi untuk ' . ($kegiatan->judul_kegiatan ?? $kegiatan->nama_kegiatan ?? 'Kegiatan'),
                ]
            ],
        ];

        try {
            // Simpan order id ke model
            $donasi->midtrans_order_id = $orderId;
            $donasi->save();

            $snapToken = Snap::getSnapToken($transaction);
        } catch (\Exception $e) {
            Log::error('Midtrans error: ' . $e->getMessage());
            return redirect()->route('kegiatan.show', $id_kegiatan)
                ->with('error', 'Terjadi kesalahan saat membuat transaksi pembayaran. Silakan coba lagi.');
        }

        return view('donasi.payment', compact('snapToken', 'donasi', 'kegiatan'));
    }

    public function midtransFinish(Request $request, $id)
    {
        $donasi = Donasi::findOrFail($id);

        $resultData = $request->input('result_data');
        $result = json_decode($resultData, true);

        if ($result) {
            // midtrans returns transaction_status like pending, capture, settlement, deny, cancel, expire
            $midStatus = $result['transaction_status'] ?? ($result['status_code'] ?? null);
            $donasi->midtrans_status = $midStatus;

            // Map midtrans status to internal enum
            if (in_array($midStatus, ['capture', 'settlement'])) {
                $donasi->status_donasi = 'Diterima';
            } elseif ($midStatus === 'pending') {
                $donasi->status_donasi = 'Menunggu Verifikasi';
            } else {
                $donasi->status_donasi = 'Ditolak';
            }

            $donasi->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
