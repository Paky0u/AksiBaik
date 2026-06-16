<x-app-layout>
    <!-- Custom styling for animations and glassmorphism -->
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
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
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Beranda Relawan') }}
            </h2>
            <a href="{{ route('home') }}" class="group flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#4379F2] to-blue-600 text-white text-sm font-semibold rounded-full shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Cari Kegiatan Lain
            </a>
        </div>
    </x-slot>

    <!-- Main Content wrapper with custom bg decoration -->
    <div class="relative min-h-screen pb-20 overflow-hidden">
        <!-- Abstract Background blobs -->
        <div class="absolute top-0 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob pointer-events-none"></div>
        <div class="absolute top-0 right-10 w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000 pointer-events-none"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000 pointer-events-none"></div>

        <div class="relative pt-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto z-10">
            
            <!-- Success Alert -->
            @if (session('success'))
                <div class="mb-8 p-4 glass-card border-l-4 border-emerald-500 rounded-2xl shadow-sm flex items-start gap-4 animate-[slideDown_0.5s_ease-out]">
                    <div class="p-2 bg-emerald-100 rounded-full">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800">Yay, Berhasil!</span>
                        <p class="text-sm text-gray-600 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Hero Section -->
            <div class="glass-card rounded-[2.5rem] p-8 md:p-12 mb-12 overflow-hidden relative shadow-xl shadow-blue-900/5 border border-white/60">
                <!-- Decorative background inside hero -->
                <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-blue-50/80 to-transparent pointer-events-none"></div>
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-50 pointer-events-none"></div>
                
                <div class="relative z-10 md:w-2/3">
                    <span class="inline-block py-1.5 px-4 rounded-full bg-white/80 backdrop-blur-sm text-[#4379F2] text-xs font-bold uppercase tracking-widest mb-6 shadow-sm border border-blue-100">Ruang Kebaikan Anda</span>
                    <h3 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-5 leading-tight tracking-tight">
                        Halo, <span class="bg-gradient-to-r from-[#4379F2] to-indigo-500 text-gradient">{{ Auth::user()->name }}!</span> 
                    </h3>
                    <p class="text-gray-500 text-lg mb-10 max-w-xl leading-relaxed">
                        Setiap langkah kecilmu membawa perubahan besar. Lacak kontribusimu, bersiap untuk aksi selanjutnya, dan teruslah menjadi pahlawan bagi mereka yang membutuhkan.
                    </p>
                    
                    @php
                        $totalKegiatan = $riwayats->count();
                        $totalDisetujui = $riwayats->where('status_pendaftaran', 'Approved')->count();
                        $totalHadir = $riwayats->where('status_kehadiran', 'Hadir')->count();
                    @endphp

                    <!-- Stats Row -->
                    <div class="flex flex-wrap gap-5">
                        <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-5 flex items-center gap-5 shadow-sm border border-white/80 min-w-[180px] hover:-translate-y-1.5 transition-transform duration-300">
                            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-[#4379F2] border border-blue-100/50">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <p class="text-3xl font-extrabold text-gray-900">{{ $totalKegiatan }}</p>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Mendaftar</p>
                            </div>
                        </div>
                        <div class="bg-white/90 backdrop-blur-sm rounded-3xl p-5 flex items-center gap-5 shadow-sm border border-white/80 min-w-[180px] hover:-translate-y-1.5 transition-transform duration-300">
                            <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center text-[#6EC207] border border-emerald-100/50">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-3xl font-extrabold text-gray-900">{{ $totalHadir }}</p>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Aksi Selesai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Title -->
            <div class="flex items-end justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Jejak Aksimu</h3>
                    <p class="text-gray-500 text-sm mt-1.5">Daftar kegiatan yang telah dan akan kamu ikuti.</p>
                </div>
            </div>

            @if($riwayats->isEmpty())
                <div class="glass-card rounded-[2.5rem] p-16 text-center shadow-sm border border-white/80 relative overflow-hidden">
                    <div class="w-32 h-32 bg-gradient-to-tr from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-8 relative">
                        <div class="absolute inset-0 bg-blue-400 rounded-full blur-xl opacity-20 animate-pulse"></div>
                        <span class="text-5xl relative z-10 drop-shadow-sm">🌱</span>
                    </div>
                    <h4 class="text-3xl font-bold text-gray-900 mb-4 tracking-tight">Jejak Masih Kosong</h4>
                    <p class="text-gray-500 text-lg mb-10 max-w-lg mx-auto leading-relaxed">
                        Dunia butuh orang baik sepertimu. Temukan kegiatan sosial yang sesuai dengan passion-mu dan mulailah membuat perubahan nyata hari ini.
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white font-bold rounded-full shadow-xl hover:shadow-gray-900/30 transition-all duration-300 hover:-translate-y-1 hover:bg-gray-800">
                        Mulai Eksplorasi
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            @else
                <!-- Grid Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($riwayats as $riwayat)
                        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-blue-900/10 border border-white/60 overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col h-full relative cursor-pointer">
                            
                            <!-- Poster Image Area -->
                            <div class="h-52 relative overflow-hidden bg-gray-100">
                                @if($riwayat->kegiatanSosial->poster_donasi)
                                    <img src="{{ asset('storage/' . $riwayat->kegiatanSosial->poster_donasi) }}" alt="Poster" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-out">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-purple-600 group-hover:scale-110 transition duration-700 ease-out flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2z"/></svg>
                                    </div>
                                @endif
                                
                                <!-- Category Badge -->
                                <div class="absolute top-5 left-5 z-20">
                                    <span class="px-3.5 py-1.5 bg-white/95 backdrop-blur-md text-gray-900 text-xs font-bold uppercase tracking-wider rounded-full shadow-sm">
                                        {{ $riwayat->kegiatanSosial->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </div>
                                
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/30 to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <div class="absolute bottom-5 left-6 right-6 z-20 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                    <h4 class="text-white font-bold text-xl leading-snug line-clamp-2 drop-shadow-lg group-hover:text-blue-100 transition-colors">
                                        {{ $riwayat->kegiatanSosial->judul_kegiatan }}
                                    </h4>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 flex-grow flex flex-col bg-white/50">
                                <div class="space-y-4 mb-8">
                                    <!-- Date -->
                                    <div class="flex items-center text-gray-600 gap-3 group-hover:text-indigo-600 transition-colors duration-300">
                                        <div class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-100 group-hover:border-indigo-100 group-hover:bg-indigo-50 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <span class="text-sm font-semibold">{{ \Carbon\Carbon::parse($riwayat->kegiatanSosial->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                    </div>
                                    <!-- Location -->
                                    <div class="flex items-center text-gray-600 gap-3">
                                        <div class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        </div>
                                        <span class="text-sm font-semibold line-clamp-1">{{ $riwayat->kegiatanSosial->lokasi }}</span>
                                    </div>
                                </div>

                                <!-- Status Indicators -->
                                <div class="mt-auto grid grid-cols-2 gap-4 pt-5 border-t border-gray-100/60">
                                    <!-- Status Pendaftaran -->
                                    <div class="bg-white rounded-2xl p-3.5 text-center shadow-sm border border-gray-50/50">
                                        <p class="text-[9px] text-gray-400 uppercase tracking-widest font-bold mb-2">Pendaftaran</p>
                                        @if($riwayat->status_pendaftaran == 'Pending')
                                            <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-yellow-50 text-yellow-700 text-xs font-bold rounded-lg w-full border border-yellow-100/50">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                                Diproses
                                            </div>
                                        @elseif($riwayat->status_pendaftaran == 'Approved')
                                            <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg w-full border border-emerald-100/50">
                                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                Disetujui
                                            </div>
                                        @else
                                            <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-rose-50 text-rose-700 text-xs font-bold rounded-lg w-full border border-rose-100/50">
                                                <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Ditolak
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Status Kehadiran -->
                                    <div class="bg-white rounded-2xl p-3.5 text-center shadow-sm border border-gray-50/50 flex flex-col justify-between">
                                        <p class="text-[9px] text-gray-400 uppercase tracking-widest font-bold mb-2">Kehadiran</p>
                                        @if($riwayat->status_kehadiran == 'Belum Dikonfirmasi')
                                            <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-gray-50 text-gray-500 text-xs font-bold rounded-lg w-full border border-gray-100/50">
                                                Belum
                                            </div>
                                        @elseif($riwayat->status_kehadiran == 'Hadir')
                                            <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg w-full border border-blue-100/50 mb-1.5">
                                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Hadir
                                            </div>
                                            <a href="{{ route('relawan.sertifikat', $riwayat->id_pendaftaran) }}" target="_blank" class="relative z-40 inline-flex items-center justify-center gap-1 text-[10px] font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 px-2 py-1 rounded-md shadow-sm transition-colors cursor-pointer">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                Sertifikat
                                            </a>
                                        @else
                                            <div class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg w-full border border-gray-200/50">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                                Absen
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Click overlay -->
                            <a href="{{ route('kegiatan.show', $riwayat->id_kegiatan) }}" class="absolute inset-0 z-30" aria-label="Lihat Detail Acara"></a>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Riwayat Pembayaran Donasi -->
            <div class="mt-12">
                <div class="flex items-end justify-between mb-4">
                    <div>
                        <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">Riwayat Pembayaran</h3>
                        <p class="text-gray-500 text-sm mt-1.5">Riwayat donasi uang yang Anda lakukan.</p>
                    </div>
                </div>

                @if(isset($donasis) && $donasis->isEmpty())
                    <div class="text-center py-8 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <p class="text-gray-500">Belum ada riwayat pembayaran.</p>
                    </div>
                @else
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-white/80">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Kegiatan</th>
                                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Nominal</th>
                                    <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($donasis as $d)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-600">{{ \Carbon\Carbon::parse($d->created_at)->translatedFormat('d M Y H:i') }}</td>
                                        <td class="px-4 py-3 text-sm font-semibold text-gray-900">{{ $d->kegiatanSosial->judul_kegiatan ?? 'Kegiatan' }}</td>
                                        <td class="px-4 py-3 text-sm font-extrabold text-[#117554]">Rp {{ number_format($d->nominal_donasi, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @php
                                                $mid = $d->midtrans_status ?? null;
                                            @endphp
                                            @if($mid === 'pending')
                                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">Pending</span>
                                            @elseif(in_array($mid, ['capture','settlement']))
                                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Berhasil</span>
                                            @else
                                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">Gagal / Tidak Terbayar</span>
                                            @endif
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