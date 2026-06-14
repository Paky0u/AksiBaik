<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Koordinator Yayasan') }}
            </h2>
            <!-- Tombol Buat Kegiatan Baru dengan warna #6EC207 -->
            <a href="{{ route('koordinator.kegiatan.create') }}" class="inline-flex items-center px-4 py-2 bg-[#6EC207] hover:bg-[#117554] text-white text-sm font-bold rounded-lg shadow-md hover:shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Kegiatan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Session Sukses -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-[#6EC207] text-[#117554] rounded-r-xl shadow-sm flex items-start gap-3 animate-fade-in">
                    <svg class="w-6 h-6 shrink-0 text-[#6EC207]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <span class="font-bold">Berhasil!</span>
                        <p class="text-sm mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Selamat Datang Koordinator -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-b border-gray-200 mb-8 p-6 md:p-8">
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#117554]">
                    {{ Auth::user()->name }}
                </h1>
                <p class="text-gray-600 mt-2 text-sm md:text-base">
                    Kelola program kemanusiaan, pantau kehadiran relawan, dan verifikasi donasi masuk di bawah naungan yayasan Anda.
                </p>
            </div>

            <!-- Bagian Tabel Kegiatan - Responsif & Scrollable Horizontal -->
            <div class="bg-white shadow-sm sm:rounded-2xl overflow-hidden">
                <div class="p-6 bg-white border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Kegiatan Yayasan</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Seluruh daftar kegiatan sosial yang telah dipublikasikan</p>
                    </div>
                    <div class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full inline-block self-start">
                        Total: {{ $kegiatanSosials->count() }} Kegiatan
                    </div>
                </div>

                <div class="p-0">
                    <!-- Container Responsif agar bisa di-scroll secara horizontal di HP -->
                    <div class="w-full overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                                    <th class="py-4 px-6">Judul Kegiatan</th>
                                    <th class="py-4 px-6">Kategori</th>
                                    <th class="py-4 px-6">Lokasi</th>
                                    <th class="py-4 px-6 text-center">Tanggal & Waktu</th>
                                    <th class="py-4 px-6 text-center">Kuota Relawan</th>
                                    <th class="py-4 px-6 text-right">Target Donasi</th>
                                    <th class="py-4 px-6 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-sm">
                                @forelse ($kegiatanSosials as $kegiatan)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="py-4 px-6 font-semibold text-gray-800">
                                            {{ $kegiatan->judul_kegiatan }}
                                            <span class="block text-xs text-gray-400 font-normal mt-0.5">Oleh: {{ $kegiatan->koordinator->name ?? 'Yayasan' }}</span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="px-2.5 py-1 bg-blue-50 text-[#4379F2] text-xs font-semibold rounded-md">
                                                {{ $kegiatan->kategori->nama_kategori ?? 'Umum' }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-gray-600">
                                            {{ Str::limit($kegiatan->lokasi, 30) }}
                                        </td>
                                        <td class="py-4 px-6 text-center text-gray-600">
                                            <span class="font-medium block text-xs">
                                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d M Y') }}
                                            </span>
                                            <span class="text-xs text-gray-400">
                                                {{ \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('H:i') }} WIB
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-center font-bold text-gray-700">
                                            {{ $kegiatan->kuota_relawan }} <span class="text-xs text-gray-400 font-normal">orang</span>
                                        </td>
                                        <td class="py-4 px-6 text-right font-medium text-gray-800">
                                            @if($kegiatan->target_donasi)
                                                Rp {{ number_format($kegiatan->target_donasi, 0, ',', '.') }}
                                            @else
                                                <span class="text-gray-400 text-xs italic">Tidak Butuh Donasi</span>
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
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-12 px-6 text-center text-gray-500 italic bg-gray-50/30">
                                            Belum ada kegiatan sosial yang dibuat oleh yayasan Anda. Klik tombol "Buat Kegiatan Baru" untuk mulai.
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