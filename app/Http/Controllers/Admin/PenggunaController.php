<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Fitur filter berdasarkan role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Urutkan dari yang terbaru
        $penggunas = $query->orderBy('created_at', 'desc')->get();

        return view('admin.pengguna.index', compact('penggunas'));
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        
        // Mencegah admin mengedit akunnya sendiri melalui fitur ini (sebaiknya lewat profil)
        // atau kita biarkan saja dengan peringatan. Kita biarkan saja untuk fleksibilitas.

        return view('admin.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:admin,koordinator,relawan',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'telepon' => 'nullable|string|max:20',
        ]);

        $pengguna->update([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Profil pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);

        if ($pengguna->id === auth()->id()) {
            return redirect()->route('admin.pengguna.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        try {
            $pengguna->delete();
            return redirect()->route('admin.pengguna.index')
                ->with('success', 'Akun pengguna berhasil dihapus secara permanen.');
        } catch (\Exception $e) {
            return redirect()->route('admin.pengguna.index')
                ->with('error', 'Pengguna tidak dapat dihapus karena masih memiliki data (kegiatan/donasi/relawan) yang terkait dengannya.');
        }
    }
}
