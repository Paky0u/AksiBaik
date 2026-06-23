<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Selamat Datang Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-b border-gray-200 mb-8 p-6 md:p-8 transform hover:scale-[1.01] transition-transform duration-300">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-[#117554]">
                            Selamat Datang, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-gray-600 mt-2 text-sm md:text-base">
                            Panel kendali utama AksiBaik. Pantau perkembangan kontribusi relawan dan perolehan donasi secara langsung.
                        </p>
                    </div>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center gap-3">
                        <div class="w-2.5 h-2.5 rounded-full bg-[#6ef3d6] animate-pulse"></div>
                        <span class="text-sm font-semibold text-blue-800">Sistem Berjalan Aktif</span>
                    </div>
                </div>
            </div>

            <!-- Stats Grid - Mobile First (1 Col, 3 Col on Desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Total Relawan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-l-8 border-[#0ecedb] p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Relawan Terdaftar</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-2">
                                {{ $totalRelawan }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">Pemuda, komunitas, & individu aktif</p>
                        </div>
                        <div class="p-4 bg-blue-50 text-[#0ecedb] rounded-2xl">
                            <!-- Icon: User Group -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Kegiatan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-l-8 border-[#6ef3d6] p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Kegiatan Sosial</p>
                            <h3 class="text-4xl font-extrabold text-gray-800 mt-2">
                                {{ $totalKegiatan }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">Program aktif, selesai, & rencana</p>
                        </div>
                        <div class="p-4 bg-green-50 text-[#6ef3d6] rounded-2xl">
                            <!-- Icon: Document Text / Calendar -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Total Donasi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-l-8 border-[#117554] p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Total Dana Donasi Diterima</p>
                            <h3 class="text-3xl font-extrabold text-gray-800 mt-2">
                                Rp {{ number_format($totalDonasi, 0, ',', '.') }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-1">Amanah terverifikasi & tersalurkan</p>
                        </div>
                        <div class="p-4 bg-emerald-50 text-[#117554] rounded-2xl">
                            <!-- Icon: Cash / Dollar -->
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Board & Quick Links -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 md:p-8">
                <h3 class="text-lg font-bold text-gray-800 border-b border-gray-100 pb-4">Menu Pintasan Manajemen</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl hover:bg-gray-50 hover:border-blue-200 transition-all group">
                        <div class="p-3 bg-blue-100 text-[#0ecedb] rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm md:text-base">Kelola Kategori</h4>
                            <p class="text-xs text-gray-500 mt-1">Mengatur kategori program sosial</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.pengguna.index') }}" class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl hover:bg-gray-50 hover:border-blue-200 transition-all group">
                        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm md:text-base">Kelola Pengguna</h4>
                            <p class="text-xs text-gray-500 mt-1">Mengelola hak akses dan profil user</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.verifikasi.kegiatan.index') }}" class="flex items-center gap-4 p-4 border border-gray-100 rounded-xl hover:bg-gray-50 hover:border-blue-200 transition-all group">
                        <div class="p-3 bg-emerald-100 text-[#117554] rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm md:text-base">Persetujuan Kegiatan</h4>
                            <p class="text-xs text-gray-500 mt-1">Verifikasi pengajuan program sosial</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>