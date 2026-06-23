<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
            {{ __('Verifikasi & Absensi Relawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white/80 backdrop-blur-xl border border-white/50 overflow-hidden shadow-sm sm:rounded-[2rem] shadow-blue-900/5">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900">Daftar Relawan per Kegiatan</h3>
                        <p class="text-sm text-gray-500 mt-1">Klik pada setiap kegiatan untuk melihat dan memverifikasi relawan yang mendaftar.</p>
                    </div>

                    @if($pendaftarans->isEmpty())
                        <div class="text-center py-12 px-4 bg-gray-50/50 rounded-2xl border border-dashed border-gray-200">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Pendaftar</h3>
                            <p class="text-gray-500 mb-4">Belum ada relawan yang mendaftar ke kegiatan Anda.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($pendaftarans as $id_kegiatan => $listPendaftar)
                                @php
                                    $kegiatan = $listPendaftar->first()->kegiatanSosial;
                                @endphp
                                
                                <div x-data="{ expanded: false }" class="border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm transition-all duration-300">
                                    <!-- Header Accordion -->
                                    <button @click="expanded = !expanded" class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition-colors focus:outline-none focus:bg-gray-50">
                                        <div class="flex items-center gap-4 text-left">
                                            <div class="w-12 h-12 rounded-full bg-blue-50 text-[#0ecedb] flex items-center justify-center shadow-inner">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-extrabold text-gray-900">{{ $kegiatan->judul_kegiatan }}</h4>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                                    <span class="text-sm font-semibold text-[#0ecedb]">{{ $listPendaftar->count() }} Pendaftar</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-gray-400 transition-transform duration-300" :class="{'rotate-180': expanded}">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </button>

                                    <!-- Konten Accordion -->
                                    <div x-show="expanded" x-collapse x-cloak>
                                        <div class="border-t border-gray-100 bg-gray-50/50 p-6 overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Relawan</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Kontak</th>
                                                        <th scope="col" class="px-6 py-3 text-center text-xs font-extrabold text-gray-500 uppercase tracking-wider">Status & Kehadiran</th>
                                                        <th scope="col" class="px-6 py-3 text-right text-xs font-extrabold text-gray-500 uppercase tracking-wider">Aksi Verifikasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200">
                                                    @foreach($listPendaftar as $pendaftaran)
                                                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm font-bold text-gray-900">{{ $pendaftaran->relawan->name }}</div>
                                                                <div class="text-xs text-gray-500">Mendaftar: {{ \Carbon\Carbon::parse($pendaftaran->waktu_daftar)->translatedFormat('d M Y H:i') }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm text-gray-900">{{ $pendaftaran->relawan->email }}</div>
                                                                <div class="text-xs text-gray-500">{{ $pendaftaran->relawan->telepon ?? 'Tidak ada nomor telepon' }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                <div class="flex flex-col items-center gap-2">
                                                                    @if($pendaftaran->status_pendaftaran == 'Approved')
                                                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Diterima</span>
                                                                    @elseif($pendaftaran->status_pendaftaran == 'Rejected')
                                                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">Ditolak</span>
                                                                    @else
                                                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">Menunggu</span>
                                                                    @endif

                                                                    @if($pendaftaran->status_pendaftaran == 'Approved')
                                                                        @if($pendaftaran->status_kehadiran == 'Hadir')
                                                                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold bg-blue-100 text-[#0ecedb]">Hadir (Valid)</span>
                                                                        @elseif($pendaftaran->status_kehadiran == 'Tidak Hadir')
                                                                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-bold bg-gray-200 text-gray-600">Tidak Hadir</span>
                                                                        @else
                                                                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-500">Belum Ada Absen</span>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <form action="{{ route('koordinator.absensi.update', $pendaftaran->id_pendaftaran) }}" method="POST" class="flex flex-col items-end gap-2">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    
                                                                    <div class="flex items-center gap-2">
                                                                        <select name="status_pendaftaran" class="text-sm border-gray-300 rounded-lg shadow-sm focus:border-[#0ecedb] focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                                            <option value="Pending" {{ $pendaftaran->status_pendaftaran == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                                            <option value="Approved" {{ $pendaftaran->status_pendaftaran == 'Approved' ? 'selected' : '' }}>Terima</option>
                                                                            <option value="Rejected" {{ $pendaftaran->status_pendaftaran == 'Rejected' ? 'selected' : '' }}>Tolak</option>
                                                                        </select>

                                                                        @if($pendaftaran->status_pendaftaran == 'Approved')
                                                                        <select name="status_kehadiran" class="text-sm border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                                                            <option value="Belum Dikonfirmasi" {{ $pendaftaran->status_kehadiran == 'Belum Dikonfirmasi' ? 'selected' : '' }}>Belum Absen</option>
                                                                            <option value="Hadir" {{ $pendaftaran->status_kehadiran == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                                                            <option value="Tidak Hadir" {{ $pendaftaran->status_kehadiran == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                                                        </select>
                                                                        @endif
                                                                    </div>
                                                                    
                                                                    <button type="submit" class="px-3 py-1.5 bg-gray-900 text-white text-xs font-bold rounded-lg hover:bg-[#0ecedb] transition-colors">
                                                                        Simpan
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
