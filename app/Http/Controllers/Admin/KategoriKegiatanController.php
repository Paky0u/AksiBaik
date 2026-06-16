<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKegiatan;

class KategoriKegiatanController extends Controller
{
    public function index()
    {
        $kategoris = KategoriKegiatan::orderBy('nama_kategori')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_kegiatans,nama_kategori',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriKegiatan::create($request->all());

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori kegiatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = KategoriKegiatan::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriKegiatan::findOrFail($id);
        
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_kegiatans,nama_kategori,' . $id . ',id_kategori',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->all());

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriKegiatan::findOrFail($id);
        // Bisa tambahkan logika cek apakah kategori ini sudah digunakan di KegiatanSosial
        // Jika sudah digunakan, tolak penghapusan atau set null di KegiatanSosial.
        // Untuk kesederhanaan saat ini, kita langsung hapus atau tangkap exception.
        try {
            $kategori->delete();
            return redirect()->route('admin.kategori.index')
                ->with('success', 'Kategori kegiatan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena sedang digunakan oleh kegiatan sosial.');
        }
    }
}
