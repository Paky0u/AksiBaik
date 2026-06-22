<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kegiatan - AksiBaik</title>
    
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
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    
    <!-- Navbar -->
    <nav class="glass-nav fixed w-full z-50 transition-all duration-300 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#4379F2] to-[#6EC207] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        AB
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-gray-900 group-hover:text-[#4379F2] transition-colors">Aksi<span class="text-[#6EC207]">Baik</span></span>
                </a>
                
                <!-- Links -->
                <div>
                    @if (Route::has('login'))
                        <div class="flex items-center gap-6">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-[#4379F2] transition">Ke Dasbor Saya</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-[#4379F2] transition relative group">
                                    Masuk
                                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-[#4379F2] transition-all group-hover:w-full"></span>
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-bold rounded-full shadow-xl shadow-gray-900/20 hover:shadow-gray-900/40 hover:-translate-y-0.5 transition-all duration-300">
                                        Bergabung Sekarang
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Spacer -->
    <div class="pt-24"></div>

    <!-- Daftar Kegiatan Section -->
    <section id="kegiatan" class="py-16 bg-gray-50 relative overflow-hidden">
        <!-- Abstract BG -->
        <div class="absolute -right-40 top-40 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute -left-40 bottom-40 w-96 h-96 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col xl:flex-row xl:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <span class="text-[#6EC207] font-bold tracking-widest uppercase text-sm mb-2 block">Etalase Kebaikan</span>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Semua Program Kebaikan</h2>
                    <p class="text-lg text-gray-500">Pilih kegiatan dan jadilah pahlawan untuk mereka yang membutuhkan.</p>
                </div>
                
                <form action="{{ route('kegiatan.publik') }}" method="GET" class="w-full xl:w-auto flex flex-col sm:flex-row gap-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan, lokasi..." class="block w-full pl-11 pr-4 py-3.5 border-gray-200 rounded-xl bg-white focus:ring-2 focus:ring-[#4379F2] focus:border-[#4379F2] transition-shadow shadow-sm font-medium">
                    </div>
                    
                    <select name="kategori_id" class="block w-full sm:w-48 pl-4 pr-10 py-3.5 border-gray-200 focus:ring-2 focus:ring-[#4379F2] focus:border-[#4379F2] rounded-xl bg-white transition-shadow shadow-sm font-medium text-gray-700">
                        <option value="">Semua Kategori</option>
                        @foreach($semuaKategori as $kategori)
                            <option value="{{ $kategori->id_kategori }}" {{ request('kategori_id') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="w-full sm:w-auto px-6 py-3.5 bg-[#4379F2] hover:bg-blue-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span>Cari</span>
                    </button>
                    
                    @if(request('search') || request('kategori_id'))
                        <a href="{{ route('kegiatan.publik') }}" class="w-full sm:w-auto px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition-all text-center flex items-center justify-center border border-gray-200">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            @if($kegiatans->isEmpty())
                <div class="bg-white rounded-[3rem] p-16 text-center shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Kegiatan Baru</h3>
                    <p class="text-gray-500">Para koordinator yayasan sedang mempersiapkan program kebaikan selanjutnya. Kembali lagi nanti!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($kegiatans as $kegiatan)
                        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-sm hover:shadow-2xl hover:shadow-blue-900/10 border border-white/60 overflow-hidden transition-all duration-500 hover:-translate-y-2 group flex flex-col h-full relative cursor-pointer">
                            
                            <!-- Poster -->
                            <div class="h-56 relative overflow-hidden bg-gray-100">
                                @if($kegiatan->poster_donasi)
                                    <img src="{{ asset('storage/' . $kegiatan->poster_donasi) }}" alt="{{ $kegiatan->judul_kegiatan }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-out">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#4379F2] to-indigo-500 group-hover:scale-110 transition duration-700 ease-out flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2z"/></svg>
                                    </div>
                                @endif
                                
                                <div class="absolute top-5 left-5 z-20">
                                    <span class="px-3.5 py-1.5 bg-white/95 backdrop-blur-md text-gray-900 text-xs font-bold uppercase tracking-wider rounded-full shadow-sm">
                                        {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </div>
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent opacity-90 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex-grow flex flex-col bg-white">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 leading-snug group-hover:text-[#4379F2] transition-colors">{{ $kegiatan->judul_kegiatan }}</h3>
                                
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="w-5 h-5 rounded-full bg-blue-50 text-[#4379F2] flex items-center justify-center font-bold text-[10px] border border-blue-100">
                                        {{ substr($kegiatan->koordinator->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="text-xs font-semibold text-gray-500">{{ $kegiatan->koordinator->name ?? 'Anonim' }}</span>
                                </div>
                                
                                <div class="space-y-3 mb-6">
                                    <div class="flex items-center text-gray-600 gap-3">
                                        <div class="p-2 bg-gray-50 rounded-lg">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        </div>
                                        <span class="text-sm font-semibold line-clamp-1">{{ $kegiatan->lokasi }}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 gap-3">
                                        <div class="p-2 bg-gray-50 rounded-lg">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <span class="text-sm font-semibold">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                    </div>
                                </div>
                                
                                <div class="pt-5 border-t border-gray-100/80 flex items-center justify-between mt-auto">
                                    <div>
                                        <span class="block text-gray-400 text-[10px] uppercase font-bold tracking-wider mb-1">Dibutuhkan</span>
                                        <span class="font-bold text-[#6EC207] bg-emerald-50 px-2 py-1 rounded-md text-sm">{{ $kegiatan->kuota_relawan }} Relawan</span>
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-[#4379F2] group-hover:text-white transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Link Overlay -->
                            <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}" class="absolute inset-0 z-30" aria-label="Lihat Detail Acara"></a>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-12 flex justify-center">
                    {{ $kegiatans->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 text-center text-sm text-gray-600">
            <p>&copy; {{ date('Y') }} AksiBaik. Membangun Kebaikan Bersama.</p>
        </div>
    </footer>
</body>
</html>
