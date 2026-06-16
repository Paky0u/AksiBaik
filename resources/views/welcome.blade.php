<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AksiBaik - Platform Kebaikan & Relawan Sosial</title>
    
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
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 6s ease-in-out 3s infinite;
        }
        .mesh-bg {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, hsla(217,100%,88%,0.5) 0px, transparent 50%),
                radial-gradient(at 100% 0%, hsla(253,100%,88%,0.5) 0px, transparent 50%),
                radial-gradient(at 100% 100%, hsla(164,100%,88%,0.5) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(217,100%,88%,0.5) 0px, transparent 50%);
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    
    <!-- Navbar -->
    <nav class="glass-nav fixed w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#4379F2] to-[#6EC207] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg group-hover:rotate-12 transition-transform duration-300">
                        AB
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-gray-900 group-hover:text-[#4379F2] transition-colors">Aksi<span class="text-[#6EC207]">Baik</span></span>
                </div>
                
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

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden mesh-bg min-h-[90vh] flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <!-- Hero Text -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/60 backdrop-blur-sm border border-white/80 shadow-sm mb-6 text-sm font-bold text-blue-600">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                        </span>
                        Platform Kebaikan #1 Indonesia
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-6 leading-[1.1]">
                        Ubah Niat Baik <br class="hidden lg:block" /> Menjadi <span class="bg-gradient-to-r from-[#4379F2] to-purple-600 text-gradient">Aksi Nyata.</span>
                    </h1>
                    
                    <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Jadilah bagian dari gerakan kebaikan. Temukan program sosial di sekitarmu, jadilah relawan, dan berikan dampak positif untuk mereka yang membutuhkan.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#kegiatan" class="px-8 py-4 bg-gradient-to-r from-[#4379F2] to-blue-600 text-white font-bold rounded-full shadow-xl shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                            Mulai Beraksi
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="#cara-kerja" class="px-8 py-4 bg-white text-gray-700 font-bold rounded-full shadow-lg hover:shadow-xl border border-gray-100 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center">
                            Pelajari Cara Kerja
                        </a>
                    </div>
                    
                    <!-- Social Proof / Stats inside Hero -->
                    <div class="mt-12 flex items-center justify-center lg:justify-start gap-8 border-t border-gray-200/60 pt-8">
                        <div>
                            <p class="text-3xl font-black text-gray-900">{{ App\Models\KegiatanSosial::count() }}+</p>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Aksi Baik</p>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div>
                            <p class="text-3xl font-black text-gray-900">{{ App\Models\User::where('role', 'Relawan')->count() }}+</p>
                            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wider">Relawan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Image/Abstract Graphic -->
                <div class="relative hidden lg:block">
                    <!-- Decorative Circle behind image -->
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-200 to-emerald-200 rounded-full blur-3xl opacity-50 animate-float"></div>
                    
                    <!-- Main image placeholder / geometric shapes since we don't have real images -->
                    <div class="relative z-10 grid grid-cols-2 gap-4 animate-float-delayed">
                        <div class="space-y-4">
                            <div class="h-48 w-full bg-gradient-to-br from-[#4379F2] to-indigo-500 rounded-[2rem] shadow-2xl flex items-center justify-center">
                                <span class="text-6xl">🤝</span>
                            </div>
                            <div class="h-64 w-full bg-gradient-to-tr from-[#6EC207] to-emerald-500 rounded-[2rem] shadow-2xl flex items-center justify-center">
                                <span class="text-6xl">🌱</span>
                            </div>
                        </div>
                        <div class="space-y-4 pt-12">
                            <div class="h-64 w-full bg-gradient-to-bl from-[#FFEB00] to-yellow-500 rounded-[2rem] shadow-2xl flex items-center justify-center">
                                <span class="text-6xl">✨</span>
                            </div>
                            <div class="h-48 w-full bg-white/80 backdrop-blur-md border border-white/50 rounded-[2rem] shadow-2xl flex items-center justify-center p-6 text-center">
                                <p class="font-bold text-xl text-gray-800">Setiap tangan yang membantu adalah pahlawan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works Section -->
    <section id="cara-kerja" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-[#4379F2] font-bold tracking-widest uppercase text-sm mb-2 block">Alur Kebaikan</span>
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Bagaimana AksiBaik Bekerja?</h2>
                <p class="text-lg text-gray-500">Tiga langkah mudah untuk mulai memberikan dampak positif bagi lingkungan sekitar Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative">
                <!-- Connecting line for desktop -->
                <div class="hidden md:block absolute top-1/2 left-[15%] right-[15%] h-0.5 bg-gray-100 -z-10 transform -translate-y-1/2"></div>
                
                <!-- Step 1 -->
                <div class="text-center group">
                    <div class="w-24 h-24 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#4379F2] group-hover:text-white transition-all duration-300 shadow-lg shadow-blue-100/50">
                        <span class="text-3xl font-black text-[#4379F2] group-hover:text-white">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Eksplorasi</h3>
                    <p class="text-gray-500 leading-relaxed">Cari program sosial atau kegiatan kerelawanan yang sesuai dengan minat dan lokasimu.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center group">
                    <div class="w-24 h-24 mx-auto bg-emerald-50 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#6EC207] group-hover:text-white transition-all duration-300 shadow-lg shadow-emerald-100/50">
                        <span class="text-3xl font-black text-[#6EC207] group-hover:text-white">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Daftar & Terlibat</h3>
                    <p class="text-gray-500 leading-relaxed">Daftarkan dirimu secara gratis. Pihak yayasan akan memverifikasi pendaftaranmu dengan cepat.</p>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center group">
                    <div class="w-24 h-24 mx-auto bg-yellow-50 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#FFEB00] group-hover:text-gray-900 transition-all duration-300 shadow-lg shadow-yellow-100/50">
                        <span class="text-3xl font-black text-yellow-600 group-hover:text-gray-900">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Aksi Nyata</h3>
                    <p class="text-gray-500 leading-relaxed">Hadir di hari kegiatan, lakukan aksi nyata, dan kembangkan jejak kebaikanmu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Kegiatan Section (using premium cards) -->
    <section id="kegiatan" class="py-24 bg-gray-50 border-t border-gray-100 relative overflow-hidden">
        <!-- Abstract BG -->
        <div class="absolute -right-40 top-40 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
        <div class="absolute -left-40 bottom-40 w-96 h-96 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                <div class="max-w-2xl">
                    <span class="text-[#6EC207] font-bold tracking-widest uppercase text-sm mb-2 block">Etalase Kebaikan</span>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">Program Terbaru</h2>
                    <p class="text-lg text-gray-500">Kesempatanmu untuk berbagi hari ini. Pilih kegiatan dan jadilah pahlawan.</p>
                </div>
                <a href="#" class="inline-flex items-center gap-2 font-bold text-[#4379F2] hover:text-blue-700 transition">
                    Lihat Semua Program 
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
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
                                <h3 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 leading-snug group-hover:text-[#4379F2] transition-colors">{{ $kegiatan->judul_kegiatan }}</h3>
                                
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
            @endif
        </div>
    </section>

    <!-- Kegiatan Selesai / Dokumentasi -->
    <section id="dokumentasi" class="py-24 bg-white border-t border-gray-100 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">Kegiatan Selesai & Dokumentasi</h2>
                    <p class="text-sm text-gray-500">Momen kebaikan yang telah terlaksana — dokumentasi dari kegiatan.</p>
                </div>
            </div>

            @if(isset($kegiatansSelesai) && $kegiatansSelesai->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($kegiatansSelesai as $k)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                            @if($k->dokumentasi_foto)
                                <img src="{{ asset('storage/' . $k->dokumentasi_foto) }}" alt="Dokumentasi {{ $k->judul_kegiatan }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h4 class="font-bold text-lg text-gray-900 mb-1">{{ $k->judul_kegiatan }}</h4>
                                <p class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($k->deskripsi, 120) }}</p>
                                <div class="mt-3 text-sm text-gray-600">
                                    <span class="font-semibold">Tanggal:</span> {{ \Carbon\Carbon::parse($k->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500">Belum ada dokumentasi kegiatan yang ditampilkan.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section for Koordinator / Admin -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-6 tracking-tight">Punya Program Sosial yang Butuh Relawan?</h2>
            <p class="text-xl text-gray-500 mb-10 max-w-2xl mx-auto">
                Daftarkan yayasan atau komunitas Anda di AksiBaik. Jangkau ribuan relawan di seluruh Indonesia dan wujudkan kebaikan bersama-sama.
            </p>
            <a href="{{ route('register') }}" class="inline-flex px-8 py-4 bg-gray-900 hover:bg-gray-800 text-white font-bold rounded-full shadow-xl shadow-gray-900/20 hover:shadow-gray-900/40 transition-all duration-300 hover:-translate-y-1">
                Daftar Sebagai Yayasan/Komunitas
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <span class="font-extrabold text-2xl tracking-tight text-white mb-4 block">Aksi<span class="text-[#6EC207]">Baik</span></span>
                <p class="text-sm max-w-md text-gray-500 leading-relaxed mx-auto md:mx-0">
                    Platform gotong royong yang mempertemukan relawan, donatur, dan program kemanusiaan untuk membangun Indonesia yang lebih baik, satu aksi pada satu waktu.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#kegiatan" class="hover:text-white transition">Program</a></li>
                    <li><a href="#" class="hover:text-white transition">Karir</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Bantuan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-white transition">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-center text-sm text-gray-600">
            <p>&copy; {{ date('Y') }} AksiBaik. Membangun Kebaikan Bersama.</p>
        </div>
    </footer>
</body>
</html>
