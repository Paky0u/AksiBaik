<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $kegiatan->judul_kegiatan }} - AksiBaik</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    
    <!-- Navbar -->
    <nav class="glass-nav sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#4379F2] to-[#6EC207] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        AB
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-gray-900 group-hover:text-[#4379F2] transition-colors">Aksi<span class="text-[#6EC207]">Baik</span></span>
                </a>
                
                <div>
                    @if (Route::has('login'))
                        <div class="flex items-center gap-6">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-[#4379F2] transition">Ke Dasbor</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-[#4379F2] transition relative group hidden sm:block">
                                    Masuk
                                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#4379F2] transition-all group-hover:w-full"></span>
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-bold rounded-full shadow-xl shadow-gray-900/20 hover:-translate-y-0.5 transition-all duration-300">
                                        Bergabung
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="relative min-h-screen pb-20 overflow-hidden">
        
        <!-- Abstract Background -->
        <div class="absolute top-0 left-0 w-full h-[500px] bg-gradient-to-b from-blue-50 via-emerald-50/50 to-transparent -z-10"></div>
        <div class="absolute -right-40 top-20 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 -z-10 animate-pulse"></div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm text-sm font-bold text-gray-600 hover:text-[#4379F2] mb-8 hover:-translate-x-1 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Eksplorasi
            </a>

            <!-- Main Detail Card -->
            <div class="glass-card rounded-[2.5rem] shadow-2xl shadow-blue-900/5 overflow-hidden border border-white/80">
                
                <!-- Poster Banner Area -->
                <div class="relative h-64 sm:h-80 md:h-[400px] w-full bg-gray-900 overflow-hidden group">
                    @if($kegiatan->poster_donasi)
                        <!-- Blurred Background for immersive feel -->
                        <img src="{{ asset('storage/' . $kegiatan->poster_donasi) }}" class="absolute inset-0 w-full h-full object-cover opacity-60 blur-2xl scale-125">
                        <!-- Main Image -->
                        <img src="{{ asset('storage/' . $kegiatan->poster_donasi) }}" alt="{{ $kegiatan->judul_kegiatan }}" class="absolute inset-0 w-full h-full object-contain transform group-hover:scale-105 transition duration-700 relative z-10 drop-shadow-2xl">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-[#4379F2] to-indigo-600 flex flex-col items-center justify-center text-white/50">
                            <svg class="w-24 h-24 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                    
                    <!-- Gradient Overlay for Text Readability -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent z-10"></div>
                    
                    <!-- Title Over Image -->
                    <div class="absolute bottom-8 left-8 right-8 z-20">
                        <span class="inline-block px-4 py-1.5 bg-[#FFEB00] text-yellow-900 text-xs font-bold uppercase tracking-wider rounded-full shadow-lg mb-4">
                            {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight drop-shadow-md">
                            {{ $kegiatan->judul_kegiatan }}
                        </h1>
                    </div>
                </div>

                <div class="p-8 md:p-12">
                    
                    <!-- Info Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                        <!-- Tanggal -->
                        <div class="bg-gray-50/80 rounded-3xl p-6 flex items-start gap-5 border border-gray-100 hover:bg-blue-50/50 transition duration-300 group">
                            <div class="w-14 h-14 rounded-2xl bg-white text-[#4379F2] flex items-center justify-center shrink-0 shadow-sm border border-blue-100/50 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase tracking-widest mb-1.5">Pelaksanaan</p>
                                <p class="font-extrabold text-gray-900 text-lg">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</p>
                                <p class="text-sm font-semibold text-gray-600 mt-1">{{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div class="bg-gray-50/80 rounded-3xl p-6 flex items-start gap-5 border border-gray-100 hover:bg-emerald-50/50 transition duration-300 group">
                            <div class="w-14 h-14 rounded-2xl bg-white text-[#6EC207] flex items-center justify-center shrink-0 shadow-sm border border-emerald-100/50 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase tracking-widest mb-1.5">Lokasi Titik Kumpul</p>
                                <p class="font-extrabold text-gray-900 text-lg leading-tight">{{ $kegiatan->lokasi }}</p>
                            </div>
                        </div>

                        <!-- Relawan -->
                        <div class="bg-gray-50/80 rounded-3xl p-6 flex items-start gap-5 border border-gray-100 hover:bg-yellow-50/50 transition duration-300 group">
                            <div class="w-14 h-14 rounded-2xl bg-white text-yellow-600 flex items-center justify-center shrink-0 shadow-sm border border-yellow-100/50 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase tracking-widest mb-1.5">Dibutuhkan</p>
                                <p class="font-extrabold text-gray-900 text-2xl">{{ $kegiatan->kuota_relawan }} <span class="text-sm font-bold text-gray-500">Relawan</span></p>
                            </div>
                        </div>

                        <!-- Donasi -->
                        @if($kegiatan->target_donasi)
                        <div class="bg-gray-50/80 rounded-3xl p-6 flex items-start gap-5 border border-gray-100 hover:bg-indigo-50/50 transition duration-300 group">
                            <div class="w-14 h-14 rounded-2xl bg-white text-indigo-600 flex items-center justify-center shrink-0 shadow-sm border border-indigo-100/50 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[11px] text-gray-500 font-bold uppercase tracking-widest mb-1.5">Target Donasi</p>
                                <p class="font-extrabold text-indigo-600 text-2xl">Rp {{ number_format($kegiatan->target_donasi, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="prose prose-lg prose-blue max-w-none mb-12 text-gray-600 leading-relaxed">
                        <h3 class="text-2xl font-extrabold text-gray-900 mb-6 tracking-tight">Tentang Program Ini</h3>
                        <div class="bg-white/80 p-8 rounded-3xl border border-gray-100 shadow-sm text-base">
                            {!! nl2br(e($kegiatan->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Action Area / CTA -->
                    <div class="border-t border-gray-200/60 pt-12 text-center bg-gray-50/30 -mx-8 -mb-8 p-8 md:p-12 rounded-b-[2.5rem]">
                        @if (session('error'))
                            <div class="mb-8 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 text-left rounded-2xl shadow-sm flex items-start gap-3 max-w-2xl mx-auto">
                                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-sm font-bold mt-0.5">{{ session('error') }}</p>
                            </div>
                        @endif

                        <h3 class="text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">Siap Mengambil Peran?</h3>
                        <p class="text-gray-500 text-lg mb-10 max-w-xl mx-auto">Bergabunglah sebagai relawan, atau berikan donasi terbaik Anda untuk membantu kelancaran program ini.</p>

                        <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                            <!-- Tombol Donasi (Selalu Muncul) -->
                            <a href="{{ route('donasi.create', $kegiatan->id_kegiatan) }}" class="w-full md:w-auto px-10 py-5 bg-gradient-to-r from-emerald-400 to-emerald-600 text-white text-xl font-bold rounded-full shadow-2xl shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center group">
                                Donasi Sekarang
                                <svg class="w-6 h-6 ml-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </a>

                            <!-- Bagian Relawan -->
                            @auth
                                @if(auth()->user()->role === 'relawan')
                                    <form action="{{ route('relawan.daftar', $kegiatan->id_kegiatan) }}" method="POST" class="w-full md:w-auto">
                                        @csrf
                                        <button type="submit" class="w-full md:w-auto px-10 py-5 bg-gradient-to-r from-[#4379F2] to-blue-600 text-white text-xl font-bold rounded-full shadow-2xl shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center group">
                                            Daftar Sebagai Relawan
                                            <svg class="w-6 h-6 ml-3 group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="w-full md:w-auto px-10 py-5 bg-white text-gray-800 border-2 border-gray-200 text-xl font-bold rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 hover:border-[#4379F2] transition-all duration-300 flex items-center justify-center">
                                    Masuk untuk Jadi Relawan
                                </a>
                            @endauth
                        </div>
                        
                        <!-- Info jika login bukan sebagai relawan -->
                        @auth
                            @if(auth()->user()->role !== 'relawan')
                                <div class="mt-8 inline-block px-8 py-4 bg-white rounded-3xl border border-gray-200 shadow-sm text-center">
                                    <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <p class="text-sm text-gray-600 font-bold mb-1">Anda login sebagai <span class="uppercase text-[#4379F2]">{{ auth()->user()->role }}</span></p>
                                    <p class="text-xs text-gray-500">Pendaftaran relawan hanya terbuka untuk akun dengan peran Relawan.</p>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm border-t border-gray-800 relative z-10">
        <p>&copy; {{ date('Y') }} AksiBaik. Membangun Indonesia yang lebih baik, bersama-sama.</p>
    </footer>
</body>
</html>
