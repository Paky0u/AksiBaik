<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
            {{ __('Riwayat Donasi Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-sm sm:rounded-[2rem] border border-gray-100 shadow-blue-900/5">
                <div class="p-8 text-gray-900">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900">Daftar Kontribusi Kebaikan Anda</h3>
                        <p class="text-sm text-gray-500 mt-1">Terima kasih atas segala bantuan dan kebaikan yang telah Anda berikan.</p>
                    </div>

                    @if($riwayatDonasi->isEmpty())
                        <div class="text-center py-16 px-4 bg-gray-50/50 rounded-2xl border border-dashed border-gray-200">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Donasi</h3>
                            <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum pernah melakukan donasi. Mari mulai sebarkan kebaikan hari ini!</p>
                            <a href="{{ route('kegiatan.publik') }}" class="inline-flex items-center px-6 py-3 bg-[#0ecedb] hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Lihat Program Kebaikan
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-gray-50/50 rounded-l-xl">Waktu Donasi</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-gray-50/50">Program Kegiatan</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-gray-50/50">Sumbangan</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-gray-50/50 rounded-r-xl">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach($riwayatDonasi as $donasi)
                                        <tr class="hover:bg-blue-50/30 transition-colors duration-200">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($donasi->created_at)->translatedFormat('d M Y') }}</div>
                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($donasi->created_at)->format('H:i') }} WIB</div>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="text-sm font-bold text-gray-900 mb-1">
                                                    <a href="{{ route('kegiatan.show', $donasi->id_kegiatan) }}" class="hover:text-[#0ecedb] transition-colors">
                                                        {{ \Illuminate\Support\Str::limit($donasi->kegiatanSosial->judul_kegiatan ?? 'Kegiatan Tidak Diketahui', 50) }}
                                                    </a>
                                                </div>
                                                @if($donasi->kegiatanSosial && $donasi->kegiatanSosial->kategori)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $donasi->kegiatanSosial->kategori->nama_kategori }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                @if($donasi->jenis_donasi === 'Uang')
                                                    <div class="text-sm font-extrabold text-[#117554]">
                                                        Rp {{ number_format($donasi->nominal_donasi, 0, ',', '.') }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">Tipe: Uang</div>
                                                @else
                                                    <div class="text-sm font-extrabold text-gray-900">
                                                        {{ $donasi->jumlah_barang }}x {{ $donasi->deskripsi_barang }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">Tipe: Barang</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                                @if($donasi->status_donasi === 'Diterima')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                        Diterima
                                                    </span>
                                                @elseif($donasi->status_donasi === 'Ditolak')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200 shadow-sm">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        Ditolak
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 shadow-sm">
                                                        <svg class="w-3 h-3 mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                        Menunggu
                                                    </span>
                                                @endif
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
