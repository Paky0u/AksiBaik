<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
            {{ __('Persetujuan Kegiatan Sosial') }}
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
                    
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Daftar Pengajuan Kegiatan</h3>
                            <p class="text-sm text-gray-500">Tinjau dan setujui kegiatan sosial yang dibuat oleh Koordinator Yayasan sebelum tayang di publik.</p>
                        </div>
                        
                        <!-- Filter Status -->
                        <form method="GET" action="{{ route('admin.verifikasi.kegiatan.index') }}" class="w-full sm:w-auto flex items-center gap-2">
                            <select name="status" onchange="this.form.submit()" class="w-full sm:w-48 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold text-gray-700 focus:ring-4 focus:ring-blue-50 focus:border-[#4379F2]">
                                <option value="">Semua Status</option>
                                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="Disetujui" {{ request('status') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </div>

                    @if($kegiatans->isEmpty())
                        <div class="text-center py-12 px-4 bg-gray-50/50 rounded-2xl border border-dashed border-gray-200">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada pengajuan</h3>
                            <p class="text-gray-500 mb-4">Belum ada kegiatan yang sesuai dengan kriteria filter Anda.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-100">
                                <thead>
                                    <tr class="bg-gray-50/50">
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider rounded-tl-xl w-1/3">Informasi Kegiatan</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Penyelenggara (Koordinator)</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Status Persetujuan</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-extrabold text-gray-500 uppercase tracking-wider rounded-tr-xl">Aksi Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white/40 divide-y divide-gray-50">
                                    @foreach($kegiatans as $kegiatan)
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $kegiatan->judul_kegiatan }}</div>
                                                <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">{{ $kegiatan->kategori->nama_kategori }}</span>
                                                    <span>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}</span>
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1 line-clamp-1" title="{{ $kegiatan->lokasi }}">
                                                    📍 {{ Str::limit($kegiatan->lokasi, 40) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center text-emerald-700 font-bold text-xs shadow-inner">
                                                        {{ strtoupper(substr($kegiatan->koordinator->name ?? '?', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-bold text-gray-900">{{ $kegiatan->koordinator->name ?? 'Tidak diketahui' }}</div>
                                                        <div class="text-xs text-gray-500">{{ $kegiatan->koordinator->email ?? '-' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($kegiatan->status_persetujuan === 'Menunggu')
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">Menunggu Tinjauan</span>
                                                @elseif($kegiatan->status_persetujuan === 'Disetujui')
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Disetujui & Publik</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex items-center justify-end gap-2">
                                                    
                                                    @if($kegiatan->status_persetujuan !== 'Disetujui')
                                                    <form action="{{ route('admin.verifikasi.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status_persetujuan" value="Disetujui">
                                                        <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-lg transition-colors shadow-sm border border-emerald-100 font-semibold text-xs" onclick="return confirm('Setujui dan tayangkan kegiatan ini ke publik?');">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                            Terima
                                                        </button>
                                                    </form>
                                                    @endif

                                                    @if($kegiatan->status_persetujuan !== 'Ditolak')
                                                    <form action="{{ route('admin.verifikasi.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status_persetujuan" value="Ditolak">
                                                        <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-lg transition-colors shadow-sm border border-rose-100 font-semibold text-xs" onclick="return confirm('Tolak kegiatan ini?');">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                            Tolak
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
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
    </div>
</x-app-layout>
