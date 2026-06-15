<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AksiBaik - Sistem Manajemen Relawan & Donasi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo-aksibaik.png') }}" alt="AksiBaik Logo" class="h-10 w-auto" onerror="this.src='https://ui-avatars.com/api/?name=Aksi+Baik&background=4379F2&color=fff'">
                    <span class="font-bold text-xl text-[#4379F2]">AksiBaik</span>
                </div>
                <div>
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-[#4379F2] transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-[#4379F2] transition">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 bg-[#FFEB00] text-gray-800 text-sm font-bold rounded-lg shadow hover:bg-[#ebd800] transition">Daftar Relawan</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-[#4379F2] text-white py-20 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-6 leading-tight">
                Mari Berbagi Kebaikan Bersama <span class="text-[#FFEB00]">AksiBaik</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                Platform gotong royong yang menghubungkan relawan dan donatur dengan berbagai program kemanusiaan, pendidikan, dan lingkungan di seluruh Indonesia.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#kegiatan" class="px-8 py-3 bg-[#FFEB00] text-gray-900 font-bold rounded-xl shadow-lg hover:bg-yellow-400 hover:-translate-y-1 transition duration-300">
                    Mulai Aksi Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Daftar Kegiatan Section -->
    <section id="kegiatan" class="py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Program Kebaikan Terbaru</h2>
                <p class="text-gray-500 mt-2">Pilih kegiatan yang ingin Anda bantu hari ini.</p>
            </div>

            @if($kegiatans->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 italic">Belum ada kegiatan yang aktif saat ini. Mari kembali lagi nanti!</p>
                </div>
            @else
                <!-- CSS Grid: 1 col on mobile, 3 cols on desktop -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($kegiatans as $kegiatan)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 flex flex-col h-full group">
                            <!-- Poster Image -->
                            <div class="h-48 overflow-hidden bg-gray-200 relative">
                                @if($kegiatan->poster_donasi)
                                    <img src="{{ asset('storage/' . $kegiatan->poster_donasi) }}" alt="{{ $kegiatan->judul_kegiatan }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-[#6EC207] text-white text-xs font-bold rounded-full shadow-sm">
                                        {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Card Content -->
                            <div class="p-6 flex-grow flex flex-col">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $kegiatan->judul_kegiatan }}</h3>
                                <div class="text-sm text-gray-500 mb-4 flex-grow">
                                    <div class="flex items-start gap-2 mb-2">
                                        <svg class="w-4 h-4 shrink-0 mt-0.5 text-[#4379F2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span class="line-clamp-1">{{ $kegiatan->lokasi }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 shrink-0 text-[#4379F2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                    </div>
                                </div>
                                
                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                                    <div class="text-sm">
                                        <span class="block text-gray-400 text-xs">Dibutuhkan</span>
                                        <span class="font-bold text-[#117554]">{{ $kegiatan->kuota_relawan }} Relawan</span>
                                    </div>
                                    <a href="{{ route('kegiatan.show', $kegiatan->id_kegiatan) }}" class="px-4 py-2 bg-[#4379F2] hover:bg-blue-700 text-white text-sm font-bold rounded-lg transition duration-200">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm">
        <p>&copy; {{ date('Y') }} AksiBaik. Membangun Indonesia yang lebih baik, bersama-sama.</p>
    </footer>
</body>
</html>
