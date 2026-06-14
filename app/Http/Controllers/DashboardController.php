<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data role pengguna yang sedang login
        $role = auth()->user()->role;

        // Arahkan ke file Blade sesuai role-nya
        if ($role === 'admin') {
            return view('admin.dashboard');
        } elseif ($role === 'koordinator') {
            return view('koordinator.dashboard');
        } else {
            return view('relawan.dashboard'); // Default untuk relawan
        }
    }
}
