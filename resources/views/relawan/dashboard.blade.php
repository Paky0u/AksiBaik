<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Relawan') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-[#6EC207] text-[#117554] rounded-r-xl shadow-sm flex items-start gap-3">
                <svg class="w-6 h-6 shrink-0 text-[#6EC207]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <span class="font-bold">Berhasil!</span>
                    <p class="text-sm mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Riwayat Acara Saya</h3>
            <p class="text-gray-500 text-sm">Lacak status pendaftaran dan kehadiran Anda pada kegiatan-kegiatan AksiBaik.</p>
        </div>

        @if($riwayats->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-20 h-20 bg-blue-50 text-[#4379F2] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Belum Ada Riwayat Kegiatan</h4>
                <p class="text-gray-500 text-sm mb-6 max-w-md mx-auto">Anda belum mendaftar di kegiatan sosial apapun. Temukan kegiatan yang sesuai dengan minat Anda dan mulailah berkontribusi!</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-[#4379F2] text-white font-bold rounded-xl shadow-md hover:bg-blue-700 transition">Cari Kegiatan</a>
            </div>
        @else
            <!-- Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($riwayats as $riwayat)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition flex flex-col h-full relative group">
                        
                        <!-- Poster Mini / Header Card -->
                        <div class="h-32 bg-gray-200 relative overflow-hidden">
                            @if($riwayat->kegiatanSosial->poster_donasi)
                                <img src="{{ asset('storage/' . $riwayat->kegiatanSosial->poster_donasi) }}" alt="Poster" class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-[#4379F2] opacity-80"></div>
                            @endif
                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            <div class="absolute bottom-3 left-4 right-4">
                                <h4 class="text-white font-bold text-lg leading-tight line-clamp-1 drop-shadow-md">{{ $riwayat->kegiatanSosial->judul_kegiatan }}</h4>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 flex-grow flex flex-col">
                            <div class="mb-4">
                                <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Pelaksanaan</p>
                                <div class="flex items-center text-sm text-gray-700 gap-2 mb-1">
                                    <svg class="w-4 h-4 text-[#4379F2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ \Carbon\Carbon::parse($riwayat->kegiatanSosial->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-700 gap-2 line-clamp-1">
                                    <svg class="w-4 h-4 text-[#4379F2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                    {{ $riwayat->kegiatanSosial->lokasi }}
                                </div>
                            </div>

                            <div class="border-t border-gray-100 pt-4 mt-auto">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex-1">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Status Pendaftaran</p>
                                        @if($riwayat->status_pendaftaran == 'Pending')
                                            <span class="inline-flex px-2.5 py-1 bg-[#FFEB00] text-yellow-800 text-xs font-bold rounded-md w-full justify-center shadow-sm">Pending</span>
                                        @elseif($riwayat->status_pendaftaran == 'Approved')
                                            <span class="inline-flex px-2.5 py-1 bg-[#6EC207] text-white text-xs font-bold rounded-md w-full justify-center shadow-sm">Disetujui</span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-md w-full justify-center shadow-sm">Ditolak</span>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Status Kehadiran</p>
                                        @if($riwayat->status_kehadiran == 'Belum Dikonfirmasi')
                                            <span class="inline-flex px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-md w-full justify-center border border-gray-200">Belum Ada</span>
                                        @elseif($riwayat->status_kehadiran == 'Hadir')
                                            <span class="inline-flex px-2.5 py-1 bg-[#117554] text-white text-xs font-bold rounded-md w-full justify-center shadow-sm">Hadir</span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 bg-rose-500 text-white text-xs font-bold rounded-md w-full justify-center shadow-sm">Tidak Hadir</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Optional: Link detail kegiatan -->
                        <a href="{{ route('kegiatan.show', $riwayat->id_kegiatan) }}" class="absolute inset-0 z-10" aria-label="Lihat detail"></a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>