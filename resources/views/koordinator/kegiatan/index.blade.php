<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Kegiatan Sosial Anda') }}
            </h2>
            <!-- Tombol Buat Kegiatan Baru dengan warna #6EC207 -->
            <a href="{{ route('koordinator.kegiatan.create') }}" class="inline-flex items-center px-4 py-2.5 bg-[#6EC207] hover:bg-[#117554] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Kegiatan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Session Sukses / Alert Informasi -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-[#6EC207] text-[#117554] rounded-r-xl shadow-sm flex items-start gap-3">
                    <svg class="w-6 h-6 shrink-0 text-[#6EC207]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <span class="font-bold">Berhasil!</span>
                        <p class="text-sm mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white shadow-sm sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="p-6 bg-white border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Kegiatan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Daftar program sosial yang Anda buat dan kelola</p>
                    </div>
                    <div class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full inline-block self-start font-semibold">
                        Total: {{ $kegiatans->count() }} Kegiatan
                    </div>
                </div>

                <div class="p-0">
                    <!-- Container Responsif agar bisa di-scroll secara horizontal di HP -->
                    <div class="w-full overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[950px]">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    <th class="py-4 px-6">Judul Kegiatan</th>
                                    <th class="py-4 px-6">Kategori</th>
                                    <th class="py-4 px-6">Lokasi</th>
                                    <th class="py-4 px-6 text-center">Tanggal & Waktu</th>
                                    <th class="py-4 px-6 text-center">Kuota Relawan</th>
                                    <th class="py-4 px-6 text-right">Target Donasi</th>
                                    <th class="py-4 px-6 text-center">Status</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse ($kegiatans as $kegiatan)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-800">
                                            {{ $kegiatan->judul_kegiatan }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="px-2.5 py-1 bg-blue-50 text-[#4379F2] text-xs font-bold rounded-md">
                                                {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-gray-600">
                                            {{ Str::limit($kegiatan->lokasi, 30) }}
                                        </td>
                                        <td class="py-4 px-6 text-center text-gray-600">
                                            <span class="font-semibold block text-xs">
                                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                            </span>
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('H:i') }} WIB
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center font-bold text-gray-700">
                                            {{ $kegiatan->kuota_relawan }} <span class="text-xs text-gray-400 font-normal">orang</span>
                                        </td>
                                        <td class="py-4 px-6 text-right font-semibold text-gray-800">
                                            @if($kegiatan->target_donasi)
                                                Rp {{ number_format($kegiatan->target_donasi, 0, ',', '.') }}
                                            @else
                                                <span class="text-gray-400 text-xs italic font-normal">Tanpa Donasi</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if ($kegiatan->status_kegiatan === 'Aktif')
                                                <span class="inline-flex items-center px-2.5 py-1 bg-emerald-50 text-[#117554] text-xs font-bold rounded-full border border-emerald-200">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-[#6EC207] me-1.5 animate-pulse"></span>
                                                    Aktif
                                                </span>
                                            @elseif ($kegiatan->status_kegiatan === 'Selesai')
                                                <span class="inline-flex items-center px-2.5 py-1 bg-gray-50 text-gray-600 text-xs font-bold rounded-full border border-gray-200">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-200">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <!-- Tombol Edit berwarna #FFEB00 -->
                                                <a href="{{ route('koordinator.kegiatan.edit', $kegiatan->id_kegiatan) }}" class="inline-flex items-center px-3 py-1.5 bg-[#FFEB00] hover:bg-[#ebd800] text-gray-800 text-xs font-bold rounded-lg shadow-sm transition">
                                                    <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>

                                                <!-- Form Hapus -->
                                                <form action="{{ route('koordinator.kegiatan.destroy', $kegiatan->id_kegiatan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg shadow-sm transition">
                                                        <svg class="w-3.5 h-3.5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-12 px-6 text-center text-gray-500 italic bg-gray-50/30">
                                            Anda belum mempublikasikan kegiatan sosial apapun. Mulai dengan mengklik "Buat Kegiatan Baru".
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
