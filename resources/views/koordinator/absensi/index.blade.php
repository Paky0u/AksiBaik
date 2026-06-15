<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Absensi Relawan') }}
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

        @if (session('error'))
            <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-r-xl shadow-sm flex items-start gap-3">
                <svg class="w-6 h-6 shrink-0 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <span class="font-bold">Gagal!</span>
                    <p class="text-sm mt-0.5">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-sm sm:rounded-2xl overflow-hidden border border-gray-100">
            <div class="p-6 bg-white border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Daftar Pendaftar</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Kelola status penerimaan dan kehadiran relawan di kegiatan Anda</p>
                </div>
                <div class="text-xs text-gray-500 bg-gray-100 px-3 py-1.5 rounded-full inline-block self-start font-semibold">
                    Total: {{ $pendaftarans->count() }} Pendaftar
                </div>
            </div>

            <div class="p-0 overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[900px]">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="py-4 px-6">Nama Relawan</th>
                            <th class="py-4 px-6">Kegiatan</th>
                            <th class="py-4 px-6 text-center">Tanggal Daftar</th>
                            <th class="py-4 px-6 text-center">Tindakan & Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse ($pendaftarans as $pendaftar)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-[#4379F2] flex items-center justify-center font-bold shrink-0">
                                            {{ substr($pendaftar->relawan->name ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800">{{ $pendaftar->relawan->name ?? 'Anonim' }}</p>
                                            <p class="text-xs text-gray-500">{{ $pendaftar->relawan->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="font-bold text-gray-800 line-clamp-1">{{ $pendaftar->kegiatanSosial->judul_kegiatan }}</p>
                                    <p class="text-xs text-[#4379F2] font-semibold">{{ \Carbon\Carbon::parse($pendaftar->kegiatanSosial->tanggal_kegiatan)->format('d M Y') }}</p>
                                </td>
                                <td class="py-4 px-6 text-center text-gray-600">
                                    {{ \Carbon\Carbon::parse($pendaftar->tanggal_pendaftaran)->format('d/m/Y H:i') }}
                                </td>
                                <td class="py-4 px-6">
                                    <form action="{{ route('koordinator.absensi.update', $pendaftar->id_pendaftaran) }}" method="POST" class="flex items-center justify-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        
                                        <!-- Dropdown Status Pendaftaran -->
                                        <select name="status_pendaftaran" class="text-xs rounded-lg border-gray-300 shadow-sm focus:border-[#4379F2] focus:ring focus:ring-[#4379F2]/20 font-semibold
                                            {{ $pendaftar->status_pendaftaran == 'Pending' ? 'bg-[#FFEB00]/20 text-yellow-800' : 
                                              ($pendaftar->status_pendaftaran == 'Approved' ? 'bg-[#6EC207]/20 text-green-800' : 'bg-red-100 text-red-800') }}">
                                            <option value="Pending" {{ $pendaftar->status_pendaftaran == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approved" {{ $pendaftar->status_pendaftaran == 'Approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="Rejected" {{ $pendaftar->status_pendaftaran == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>

                                        <!-- Dropdown Status Kehadiran -->
                                        <select name="status_kehadiran" class="text-xs rounded-lg border-gray-300 shadow-sm focus:border-[#4379F2] focus:ring focus:ring-[#4379F2]/20 font-semibold">
                                            <option value="Belum Dikonfirmasi" {{ $pendaftar->status_kehadiran == 'Belum Dikonfirmasi' ? 'selected' : '' }}>Belum Hadir</option>
                                            <option value="Hadir" {{ $pendaftar->status_kehadiran == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                            <option value="Tidak Hadir" {{ $pendaftar->status_kehadiran == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                        </select>

                                        <button type="submit" class="px-3 py-1.5 bg-[#4379F2] hover:bg-blue-700 text-white text-xs font-bold rounded-lg shadow transition">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center text-gray-500 italic bg-gray-50/30">
                                    Belum ada relawan yang mendaftar ke kegiatan Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
