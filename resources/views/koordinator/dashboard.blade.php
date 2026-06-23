<x-app-layout>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Ruang Koordinator') }}
            </h2>
            <a href="{{ route('koordinator.kegiatan.create') }}" class="group inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-[#6ef3d6] to-emerald-600 text-white text-sm font-bold rounded-full shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Buat Kegiatan Baru
            </a>
        </div>
    </x-slot>

    <div class="relative min-h-screen pb-20 overflow-hidden">
        <!-- Abstract Background blobs -->
        <div class="absolute top-0 right-10 w-80 h-80 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob pointer-events-none"></div>
        <div class="absolute top-40 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 pointer-events-none"></div>

        <div class="relative pt-8 max-w-7xl mx-auto sm:px-6 lg:px-8 z-10">
            
            <!-- Alert Session Sukses -->
            @if (session('success'))
                <div class="mb-8 p-4 glass-card border-l-4 border-[#6ef3d6] rounded-2xl shadow-sm flex items-start gap-4 animate-[slideDown_0.5s_ease-out]">
                    <div class="p-2 bg-emerald-100 rounded-full">
                        <svg class="w-6 h-6 text-[#6ef3d6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800">Berhasil!</span>
                        <p class="text-sm text-gray-600 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Hero Section -->
            <div class="glass-card rounded-[2.5rem] p-8 md:p-12 mb-10 overflow-hidden relative shadow-xl shadow-emerald-900/5 border border-white/60">
                <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-emerald-50/80 to-transparent pointer-events-none"></div>
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none"></div>
                
                <div class="relative z-10 md:w-3/4">
                    <span class="inline-block py-1.5 px-4 rounded-full bg-white/80 backdrop-blur-sm text-[#117554] text-xs font-bold uppercase tracking-widest mb-6 shadow-sm border border-emerald-100">Manajemen Yayasan</span>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight leading-tight">
                        Selamat Datang, <br class="hidden sm:block" />
                        <span class="bg-gradient-to-r from-[#117554] to-[#6ef3d6] text-gradient">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="text-gray-500 text-lg mb-8 max-w-2xl leading-relaxed">
                        Kelola program kemanusiaan, pantau kehadiran pahlawan relawan, dan verifikasi donasi masuk di bawah naungan yayasan Anda dengan mudah dan transparan.
                    </p>

                    @php
                        $totalKegiatan = $kegiatanSosials->count();
                        $kegiatanAktif = $kegiatanSosials->where('status_kegiatan', 'Aktif')->count();
                        $totalRelawanDibutuhkan = $kegiatanSosials->sum('kuota_relawan');
                    @endphp

                    <div class="flex flex-wrap gap-5">
                        <!-- Stats Card 1 -->
                        <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-5 flex items-center gap-5 shadow-sm border border-white/80 min-w-[180px] hover:-translate-y-1.5 transition-transform duration-300">
                            <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center text-[#6ef3d6] border border-emerald-100/50">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <p class="text-3xl font-extrabold text-gray-900">{{ $totalKegiatan }}</p>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Total Program</p>
                            </div>
                        </div>
                        <!-- Stats Card 2 -->
                        <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-5 flex items-center gap-5 shadow-sm border border-white/80 min-w-[180px] hover:-translate-y-1.5 transition-transform duration-300">
                            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-[#0ecedb] border border-blue-100/50">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <p class="text-3xl font-extrabold text-gray-900">{{ $kegiatanAktif }}</p>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Sedang Aktif</p>
                            </div>
                        </div>
                        <!-- Stats Card 3 -->
                        <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-5 flex items-center gap-5 shadow-sm border border-white/80 min-w-[180px] hover:-translate-y-1.5 transition-transform duration-300 hidden sm:flex">
                            <div class="w-14 h-14 rounded-full bg-yellow-50 flex items-center justify-center text-yellow-600 border border-yellow-100/50">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-3xl font-extrabold text-gray-900">{{ $totalRelawanDibutuhkan }}</p>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Kuota Relawan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Kegiatan -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-6 px-2">
                <div>
                    <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Daftar Kegiatan</h3>
                    <p class="text-gray-500 text-sm mt-1">Kelola dan pantau seluruh kegiatan yang Anda buat.</p>
                </div>
            </div>

            <div class="glass-card rounded-[2rem] overflow-hidden shadow-sm border border-white/80">
                @if($kegiatanSosials->isEmpty())
                    <div class="p-16 text-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Program</h4>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum membuat kegiatan sosial apapun. Mulailah aksi pertama Anda dengan membuat program kebaikan.</p>
                        <a href="{{ route('koordinator.kegiatan.create') }}" class="inline-flex px-6 py-3 bg-[#6ef3d6] text-white font-bold rounded-xl shadow hover:bg-[#117554] transition">
                            Buat Kegiatan Pertama
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[900px]">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="py-5 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Informasi Program</th>
                                    <th class="py-5 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Jadwal</th>
                                    <th class="py-5 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Kuota & Donasi</th>
                                    <th class="py-5 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Status</th>
                                    <th class="py-5 px-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($kegiatanSosials as $kegiatan)
                                    <tr class="hover:bg-blue-50/30 transition-colors group">
                                        <td class="py-5 px-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden shrink-0">
                                                    @if($kegiatan->poster_donasi)
                                                        <img src="{{ asset('storage/' . $kegiatan->poster_donasi) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <span class="text-xl">🌟</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900 group-hover:text-[#0ecedb] transition-colors line-clamp-1 text-base">{{ $kegiatan->judul_kegiatan }}</p>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-[10px] font-bold rounded uppercase tracking-wider">
                                                            {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                                                        </span>
                                                        <span class="text-xs text-gray-500 line-clamp-1 max-w-[150px]"><i class="fas fa-map-marker-alt mr-1"></i> {{ $kegiatan->lokasi }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="py-5 px-6 text-center">
                                            <span class="block text-sm font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                            </span>
                                            <span class="text-xs text-gray-400 mt-0.5 block">
                                                {{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('H:i') }} WIB
                                            </span>
                                        </td>
                                        
                                        <td class="py-5 px-6">
                                            <div class="flex flex-col items-center gap-2">
                                                <div class="inline-flex items-center gap-1.5 bg-blue-50 px-2.5 py-1 rounded-md">
                                                    <svg class="w-3.5 h-3.5 text-[#0ecedb]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                                    <span class="text-xs font-bold text-[#0ecedb]">{{ $kegiatan->kuota_relawan }}</span>
                                                </div>
                                                @if($kegiatan->target_donasi)
                                                    <span class="text-xs font-bold text-gray-700 bg-gray-50 px-2 py-1 rounded-md border border-gray-100">
                                                        Rp {{ number_format($kegiatan->target_donasi, 0, ',', '.') }}
                                                    </span>
                                                @else
                                                    <span class="text-[10px] text-gray-400 italic">Tanpa Donasi</span>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <td class="py-5 px-6 text-center">
                                            @if ($kegiatan->status_kegiatan === 'Aktif')
                                                <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-100">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                    Aktif
                                                </div>
                                            @elseif ($kegiatan->status_kegiatan === 'Selesai')
                                                <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full border border-gray-200">
                                                    Selesai
                                                </div>
                                            @else
                                                <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-100">
                                                    Batal
                                                </div>
                                            @endif
                                        </td>

                                        <td class="py-5 px-6 text-right">
                                            <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-50 hover:bg-[#0ecedb] text-gray-500 hover:text-white transition-colors duration-200" title="Kelola Kegiatan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            
        </div>
    </div>
</x-app-layout>