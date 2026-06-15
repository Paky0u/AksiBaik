<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $kegiatan->judul_kegiatan }} - AksiBaik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <img src="{{ asset('images/logo-aksibaik.png') }}" alt="AksiBaik Logo" class="h-10 w-auto" onerror="this.src='https://ui-avatars.com/api/?name=Aksi+Baik&background=4379F2&color=fff'">
                        <span class="font-bold text-xl text-[#4379F2]">AksiBaik</span>
                    </a>
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

    <!-- Content Section -->
    <div class="py-12 px-4">
        <div class="max-w-4xl mx-auto">
            
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-[#4379F2] mb-6 transition">
                <svg class="w-5 h-5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            <!-- Card Utama -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Poster -->
                <div class="w-full h-64 md:h-96 bg-gray-200 relative">
                    @if($kegiatan->poster_donasi)
                        <img src="{{ asset('storage/' . $kegiatan->poster_donasi) }}" alt="{{ $kegiatan->judul_kegiatan }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-blue-50 text-blue-300">
                            <svg class="w-20 h-20 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-medium">Tidak ada poster</span>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-1.5 bg-[#FFEB00] text-gray-900 text-sm font-bold rounded-full shadow-md">
                            {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-8">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-4">{{ $kegiatan->judul_kegiatan }}</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-gray-50 p-6 rounded-xl border border-gray-100">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-blue-100 text-[#4379F2] rounded-lg shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-semibold mb-0.5">Tanggal Pelaksanaan</p>
                                <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('l, d F Y') }}</p>
                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-green-100 text-[#6EC207] rounded-lg shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-semibold mb-0.5">Lokasi</p>
                                <p class="font-bold text-gray-800">{{ $kegiatan->lokasi }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-yellow-100 text-yellow-600 rounded-lg shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-semibold mb-0.5">Dibutuhkan Relawan</p>
                                <p class="font-bold text-gray-800">{{ $kegiatan->kuota_relawan }} Orang</p>
                            </div>
                        </div>
                        @if($kegiatan->target_donasi)
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-emerald-100 text-[#117554] rounded-lg shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-semibold mb-0.5">Target Donasi</p>
                                <p class="font-bold text-gray-800">Rp {{ number_format($kegiatan->target_donasi, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="prose prose-blue max-w-none mb-10 text-gray-600 leading-relaxed">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 border-b pb-2">Deskripsi Kegiatan</h3>
                        {!! nl2br(e($kegiatan->deskripsi)) !!}
                    </div>

                    <!-- Action Area -->
                    <div class="border-t border-gray-100 pt-8 mt-4 text-center">
                        @if (session('error'))
                            <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 text-left rounded-r-xl shadow-sm">
                                <p class="text-sm font-bold">{{ session('error') }}</p>
                            </div>
                        @endif

                        @auth
                            @if(auth()->user()->role === 'relawan')
                                <form action="{{ route('relawan.daftar', $kegiatan->id_kegiatan) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-[#117554] text-white text-lg font-bold rounded-xl shadow-lg hover:bg-[#0c5940] hover:-translate-y-1 transition duration-300">
                                        Daftar Sebagai Relawan
                                    </button>
                                </form>
                            @else
                                <div class="px-6 py-4 bg-gray-50 rounded-xl inline-block border border-gray-200">
                                    <p class="text-sm text-gray-600 font-semibold">Anda login sebagai <span class="uppercase text-[#4379F2]">{{ auth()->user()->role }}</span>. Pendaftaran hanya berlaku untuk akun Relawan.</p>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="inline-block w-full sm:w-auto px-8 py-3.5 bg-[#4379F2] text-white text-lg font-bold rounded-xl shadow-lg hover:bg-blue-700 hover:-translate-y-1 transition duration-300">
                                Login untuk Daftar
                            </a>
                            <p class="text-sm text-gray-500 mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-[#4379F2] font-bold hover:underline">Daftar sekarang</a></p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm mt-12">
        <p>&copy; {{ date('Y') }} AksiBaik. Membangun Indonesia yang lebih baik, bersama-sama.</p>
    </footer>
</body>
</html>
