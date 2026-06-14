<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Kegiatan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Profil Singkat Relawan -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-b border-gray-200 mb-8 p-6 md:p-8">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-[#4379F2] text-2xl font-bold uppercase border-2 border-[#4379F2]">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div class="text-center md:text-left">
                        <h1 class="text-2xl md:text-3xl font-extrabold text-[#117554]">
                            Halo, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-gray-600 mt-1 text-sm md:text-base">
                            Terima kasih atas kepedulian Anda. Di sini Anda dapat memantau riwayat program kemanusiaan yang Anda ikuti.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Grid Card - Mobile First (1 Col on mobile, 3 Col on PC) -->
            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Kegiatan Diikuti</h3>
                <span class="text-xs text-gray-500 bg-white shadow-sm border border-gray-100 px-3 py-1 rounded-full">
                    Total Partisipasi: {{ $riwayatKegiatan->count() }} Kegiatan
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($riwayatKegiatan as $riwayat)
                    @php
                        $kegiatan = $riwayat->kegiatanSosial;
                    @endphp
                    @if ($kegiatan)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">
                            <div class="p-6">
                                <!-- Kategori Badge -->
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-2.5 py-1 bg-blue-50 text-[#4379F2] text-xs font-bold rounded-md">
                                        {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        Reg: {{ \Carbon\Carbon::parse($riwayat->tanggal_pendaftaran)->translatedFormat('d M Y') }}
                                    </span>
                                </div>

                                <!-- Judul Kegiatan -->
                                <h4 class="font-extrabold text-gray-800 text-lg leading-snug mb-3 hover:text-[#4379F2] transition-colors">
                                    {{ $kegiatan->judul_kegiatan }}
                                </h4>

                                <!-- Info Koordinator, Lokasi, dan Tanggal -->
                                <div class="space-y-2 text-xs text-gray-600 mb-5">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                        <span>Penyelenggara: <span class="font-semibold">{{ $kegiatan->koordinator->name ?? 'Yayasan' }}</span></span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span>{{ Str::limit($kegiatan->lokasi, 35) }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                    </div>
                                </div>

                                <!-- Status Pendaftaran -->
                                <div class="border-t border-gray-50 pt-4 flex flex-col gap-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 font-medium">Status Pendaftaran:</span>
                                        @if ($riwayat->status_pendaftaran === 'Approved')
                                            <span class="inline-flex items-center px-2 py-0.5 bg-emerald-50 text-[#117554] text-xs font-bold rounded-full border border-emerald-100">
                                                Disetujui
                                            </span>
                                        @elseif ($riwayat->status_pendaftaran === 'Pending')
                                            <span class="inline-flex items-center px-2 py-0.5 bg-amber-50 text-amber-700 text-xs font-bold rounded-full border border-amber-100">
                                                Menunggu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-100">
                                                Ditolak
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Status Kehadiran -->
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 font-medium">Kehadiran:</span>
                                        @if ($riwayat->status_kehadiran === 'Hadir')
                                            <span class="inline-flex items-center px-2 py-0.5 bg-emerald-100 text-[#117554] text-xs font-bold rounded-full">
                                                Hadir
                                            </span>
                                        @elseif ($riwayat->status_kehadiran === 'Tidak Hadir')
                                            <span class="inline-flex items-center px-2 py-0.5 bg-rose-100 text-rose-800 text-xs font-bold rounded-full">
                                                Tidak Hadir
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">
                                                Belum Absen
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan Admin jika ada -->
                            @if ($riwayat->catatan_admin)
                                <div class="bg-gray-50/70 p-4 border-t border-gray-100 text-xs text-gray-600 italic">
                                    <span class="font-semibold not-italic block text-gray-700 mb-0.5">Catatan Koordinasi:</span>
                                    "{{ $riwayat->catatan_admin }}"
                                </div>
                            @endif
                        </div>
                    @endif
                @empty
                    <div class="col-span-1 md:col-span-3 text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <div class="p-4 bg-gray-50 text-gray-400 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-700 text-lg">Belum Ada Riwayat Kegiatan</h4>
                        <p class="text-gray-500 text-sm mt-1 max-w-md mx-auto">
                            Anda belum terdaftar pada kegiatan sosial manapun. Silakan jelajahi kegiatan yang dibuka oleh yayasan untuk mulai berkontribusi.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>