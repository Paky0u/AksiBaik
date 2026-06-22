<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UmpanBalik;

class UmpanBalikController extends Controller
{
    public function destroy($id)
    {
        $umpanBalik = UmpanBalik::findOrFail($id);
        $umpanBalik->delete();
        
        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }
}

