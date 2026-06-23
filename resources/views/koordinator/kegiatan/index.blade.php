<x-app-layout>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
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
    </style>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Kelola Program Sosial') }}
            </h2>
            <a href="{{ route('koordinator.kegiatan.create') }}" class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#6ef3d6] to-emerald-600 text-white text-sm font-bold rounded-full shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Buat Program Baru
            </a>
        </div>
    </x-slot>

    <div class="relative min-h-screen pb-20 overflow-hidden">
        <!-- Abstract Background -->
        <div class="absolute top-20 right-10 w-96 h-96 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob pointer-events-none"></div>
        <div class="absolute top-40 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000 pointer-events-none"></div>

        <div class="relative pt-8 max-w-7xl mx-auto sm:px-6 lg:px-8 z-10">

            @if (session('success'))
                <div class="mb-8 p-4 glass-card border-l-4 border-[#6ef3d6] rounded-2xl shadow-sm flex items-start gap-4">
                    <div class="p-2 bg-emerald-100 rounded-full">
                        <svg class="w-6 h-6 text-[#6ef3d6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-800">Berhasil!</span>
                        <p class="text-sm text-gray-600 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Hero Panel -->
            <div class="glass-card rounded-[2rem] p-8 mb-10 border border-white/80 shadow-xl shadow-blue-900/5 flex flex-col md:flex-row md:items-center justify-between gap-8 relative overflow-hidden">
                <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-emerald-50/50 to-transparent pointer-events-none"></div>
                
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-[#6ef3d6]/10 text-[#6ef3d6] rounded-2xl flex items-center justify-center mb-4 border border-[#6ef3d6]/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Daftar Program Sosial Anda</h3>
                    <p class="text-gray-500 text-sm max-w-lg">Semua kegiatan sosial yang telah Anda rilis ada di sini. Pantau status, kumpulkan relawan, dan wujudkan aksi baik bersama.</p>
                </div>
                
                <div class="relative z-10 flex flex-col sm:flex-row gap-4 shrink-0">
                    <div class="bg-white/80 backdrop-blur-sm px-6 py-4 rounded-2xl border border-white shadow-sm flex items-center gap-4">
                        <div class="w-10 h-10 bg-blue-100 text-[#0ecedb] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-0.5">Total Kegiatan</p>
                            <p class="text-2xl font-black text-gray-900">{{ $kegiatans->count() }}</p>
                        </div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-sm px-6 py-4 rounded-2xl border border-white shadow-sm flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-0.5">Aktif Berjalan</p>
                            <p class="text-2xl font-black text-[#6ef3d6]">{{ $kegiatans->where('status_kegiatan', 'Aktif')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Container -->
            <div class="glass-card rounded-[2rem] overflow-hidden shadow-sm border border-white/80 mb-10">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[1000px]">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-xs font-bold text-gray-400 uppercase tracking-widest">
                                <th class="py-5 px-6">Program & Kategori</th>
                                <th class="py-5 px-6">Pelaksanaan & Lokasi</th>
                                <th class="py-5 px-6 text-center">Kebutuhan</th>
                                <th class="py-5 px-6 text-center">Status</th>
                                <th class="py-5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($kegiatans as $kegiatan)
                                <tr class="hover:bg-emerald-50/30 transition-colors group">
                                    <td class="py-5 px-6">
                                        <p class="font-extrabold text-gray-900 text-base mb-1.5 group-hover:text-emerald-600 transition-colors">{{ $kegiatan->judul_kegiatan }}</p>
                                        <span class="inline-flex items-center px-2.5 py-1 bg-yellow-100/50 text-yellow-700 text-[10px] font-bold rounded-md border border-yellow-200/50">
                                            {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                                        </span>
                                    </td>
                                    
                                    <td class="py-5 px-6">
                                        <div class="flex items-center gap-2 mb-1">
                                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="text-sm font-bold text-gray-800">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                        </div>
                                        <p class="text-xs text-gray-500 font-medium ms-6 truncate max-w-[200px]">{{ $kegiatan->lokasi }}</p>
                                    </td>
                                    
                                    <td class="py-5 px-6 text-center">
                                        <div class="inline-flex flex-col gap-1 text-left">
                                            <div class="text-xs font-semibold text-gray-700 bg-white/80 px-2.5 py-1 rounded-md border border-gray-100 flex justify-between gap-4 shadow-sm">
                                                <span class="text-gray-400">Relawan:</span>
                                                <span class="font-bold">{{ $kegiatan->kuota_relawan }}</span>
                                            </div>
                                            @if($kegiatan->target_donasi)
                                            <div class="text-[11px] font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md border border-indigo-100 shadow-sm">
                                                Rp{{ number_format($kegiatan->target_donasi, 0, ',', '.') }}
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                    
                                    <td class="py-5 px-6 text-center">
                                        @if ($kegiatan->status_kegiatan === 'Aktif')
                                            <span class="inline-flex items-center px-3 py-1.5 bg-emerald-50 text-[#117554] text-xs font-bold rounded-full border border-emerald-100 shadow-sm">
                                                <span class="w-2 h-2 rounded-full bg-[#6ef3d6] me-2 animate-pulse"></span>
                                                Berjalan
                                            </span>
                                        @elseif ($kegiatan->status_kegiatan === 'Selesai')
                                            <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-full border border-gray-200">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-100">
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="py-5 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('koordinator.kegiatan.edit', $kegiatan->id_kegiatan) }}" class="p-2.5 bg-blue-50 text-[#0ecedb] hover:bg-[#0ecedb] hover:text-white rounded-xl transition-all shadow-sm border border-blue-100 hover:shadow-md hover:-translate-y-0.5" title="Edit Kegiatan">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>

                                            <form action="{{ route('koordinator.kegiatan.destroy', $kegiatan->id_kegiatan) }}" method="POST" onsubmit="return confirm('Tindakan ini tidak bisa dibatalkan. Yakin ingin menghapus kegiatan ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2.5 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all shadow-sm border border-rose-100 hover:shadow-md hover:-translate-y-0.5" title="Hapus Kegiatan">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-16 px-6 text-center">
                                        <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        </div>
                                        <h4 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Program</h4>
                                        <p class="text-gray-500 max-w-sm mx-auto mb-6">Mulai sebarkan kebaikan dengan membuat program sosial pertama Anda. Kami tidak sabar melihat inisiatif Anda!</p>
                                        <a href="{{ route('koordinator.kegiatan.create') }}" class="inline-flex items-center px-6 py-2.5 bg-[#6ef3d6] hover:bg-emerald-600 text-white font-bold rounded-full shadow-lg transition">
                                            Buat Program Sekarang
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
