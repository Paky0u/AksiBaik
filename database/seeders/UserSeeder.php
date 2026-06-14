<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@aksibaik.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'no_telp' => '081111111111',
            'alamat' => 'Kantor Pusat AksiBaik',
        ]);

        // 2. Akun Koordinator (Yayasan)
        User::create([
            'name' => 'Yayasan Peduli Sesama',
            'email' => 'yayasan@aksibaik.test',
            'password' => Hash::make('password'),
            'role' => 'koordinator',
            'no_telp' => '082222222222',
            'alamat' => 'Jl. Kemanusiaan No. 1, Jakarta',
        ]);

        // 3. Akun Relawan
        User::create([
            'name' => 'Relawan Aktif',
            'email' => 'relawan@aksibaik.test',
            'password' => Hash::make('password'),
            'role' => 'relawan',
            'no_telp' => '083333333333',
            'alamat' => 'Jl. Kebajikan No. 2, Jakarta',
        ]);
    }
}