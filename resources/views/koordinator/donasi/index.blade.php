<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
            {{ __('Verifikasi Donasi') }}
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
                        <h3 class="text-xl font-bold text-gray-900">Daftar Donasi per Kegiatan</h3>
                        <p class="text-sm text-gray-500 mt-1">Klik pada setiap kegiatan untuk memeriksa bukti transfer dan memverifikasi donasi.</p>
                    </div>

                    @if($donasis->isEmpty())
                        <div class="text-center py-12 px-4 bg-gray-50/50 rounded-2xl border border-dashed border-gray-200">
                            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-gray-100">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Donasi</h3>
                            <p class="text-gray-500 mb-4">Belum ada donasi yang masuk ke kegiatan Anda.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($donasis as $id_kegiatan => $listDonasi)
                                @php
                                    $kegiatan = $listDonasi->first()->kegiatanSosial;
                                    $totalDiterima = $listDonasi->where('status_donasi', 'Diterima')->sum('nominal_donasi');
                                @endphp
                                
                                <div x-data="{ expanded: false }" class="border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm transition-all duration-300">
                                    <!-- Header Accordion -->
                                    <button @click="expanded = !expanded" class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50 transition-colors focus:outline-none focus:bg-gray-50">
                                        <div class="flex items-center gap-4 text-left">
                                            <div class="w-12 h-12 rounded-full bg-emerald-50 text-[#117554] flex items-center justify-center shadow-inner">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-extrabold text-gray-900">{{ $kegiatan->judul_kegiatan }}</h4>
                                                <div class="flex items-center gap-4 mt-1">
                                                    <span class="text-sm font-medium text-gray-500">{{ $listDonasi->count() }} Donatur</span>
                                                    <span class="text-sm font-bold text-emerald-600">Terkumpul: Rp {{ number_format($totalDiterima, 0, ',', '.') }}</span>
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
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Donatur</th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-extrabold text-gray-500 uppercase tracking-wider">Nominal & Tipe</th>
                                                        <th scope="col" class="px-6 py-3 text-center text-xs font-extrabold text-gray-500 uppercase tracking-wider">Bukti / Pesan</th>
                                                        <th scope="col" class="px-6 py-3 text-center text-xs font-extrabold text-gray-500 uppercase tracking-wider">Status</th>
                                                        <th scope="col" class="px-6 py-3 text-right text-xs font-extrabold text-gray-500 uppercase tracking-wider">Aksi Verifikasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-200">
                                                    @foreach($listDonasi as $donasi)
                                                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm font-bold text-gray-900">{{ $donasi->nama_samaran ?? ($donasi->donatur->name ?? 'Anonim') }}</div>
                                                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($donasi->created_at)->translatedFormat('d M Y H:i') }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                <div class="text-sm font-extrabold text-[#117554]">
                                                                    Rp {{ number_format($donasi->nominal_donasi, 0, ',', '.') }}
                                                                </div>
                                                                <div class="text-xs text-gray-500">Tipe: {{ $donasi->jenis_donasi }}</div>
                                                            </td>
                                                            <td class="px-6 py-4 text-center">
                                                                @if($donasi->pesan_donasi)
                                                                    <div class="text-xs italic text-gray-600 mb-2 truncate max-w-xs mx-auto" title="{{ $donasi->pesan_donasi }}">
                                                                        "{{ $donasi->pesan_donasi }}"
                                                                    </div>
                                                                @endif
                                                                
                                                                @if($donasi->bukti_pembayaran)
                                                                    <a href="{{ asset('storage/' . $donasi->bukti_pembayaran) }}" target="_blank" class="inline-flex items-center text-xs font-bold text-blue-600 hover:text-blue-800 bg-blue-50 px-2.5 py-1 rounded-full">
                                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                                        Lihat Bukti
                                                                    </a>
                                                                @else
                                                                    <span class="text-xs text-gray-400">Tanpa Bukti</span>
                                                                @endif
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                                @if($donasi->status_donasi == 'Diterima')
                                                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">Diterima</span>
                                                                @elseif($donasi->status_donasi == 'Ditolak')
                                                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">Ditolak</span>
                                                                @else
                                                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">Menunggu</span>
                                                                @endif
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                                <div class="flex items-center justify-end gap-2">
                                                                    @if($donasi->status_donasi !== 'Diterima')
                                                                    <form action="{{ route('koordinator.donasi.update', $donasi->id_donasi) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status_donasi" value="Diterima">
                                                                        <button type="submit" class="p-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white rounded-lg transition-colors shadow-sm border border-emerald-100" title="Terima Donasi" onclick="return confirm('Apakah Anda yakin donasi ini valid?');">
                                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                                        </button>
                                                                    </form>
                                                                    @endif

                                                                    @if($donasi->status_donasi !== 'Ditolak')
                                                                    <form action="{{ route('koordinator.donasi.update', $donasi->id_donasi) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status_donasi" value="Ditolak">
                                                                        <button type="submit" class="p-2 bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white rounded-lg transition-colors shadow-sm border border-rose-100" title="Tolak Donasi" onclick="return confirm('Tolak donasi ini?');">
                                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
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
