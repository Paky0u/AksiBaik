<x-app-layout>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        .input-premium {
            transition: all 0.3s ease;
        }
        .input-premium:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(67, 121, 242, 0.15), 0 8px 10px -6px rgba(67, 121, 242, 0.1);
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-[#FFEB00]/20 text-yellow-600 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Ubah Informasi Program') }}
            </h2>
        </div>
    </x-slot>

    <div class="relative min-h-screen py-10 overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-br from-yellow-100 to-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -z-10 translate-x-1/3 -translate-y-1/4"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <a href="{{ route('koordinator.kegiatan.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100 text-sm font-bold text-gray-600 hover:text-[#4379F2] mb-8 hover:-translate-x-1 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>

            <div class="glass-card rounded-[2rem] shadow-xl shadow-blue-900/5 overflow-hidden">
                <div class="px-8 py-6 bg-white/50 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Edit Data Kegiatan</h3>
                        <p class="text-sm text-gray-500 mt-1">Perbarui detail acara agar relawan mendapatkan informasi terbaru.</p>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded-full border border-yellow-200">Mode Edit</span>
                </div>

                <form action="{{ route('koordinator.kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                    @csrf
                    @method('PUT')

                    <!-- Status Kegiatan - Highlighted at top for Edit form -->
                    <div class="bg-[#4379F2]/5 p-6 rounded-2xl border border-[#4379F2]/20">
                        <label for="status_kegiatan" class="block text-sm font-bold text-[#4379F2] mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Status Perjalanan Program <span class="text-rose-500">*</span>
                        </label>
                        <select id="status_kegiatan" name="status_kegiatan" 
                            class="input-premium w-full px-5 py-3 bg-white border border-[#4379F2]/30 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/30 text-gray-900 font-bold shadow-sm" required>
                            <option value="Aktif" {{ old('status_kegiatan', $kegiatan->status_kegiatan) === 'Aktif' ? 'selected' : '' }}>🟢 Aktif (Sedang Berjalan/Menerima Pendaftar)</option>
                            <option value="Selesai" {{ old('status_kegiatan', $kegiatan->status_kegiatan) === 'Selesai' ? 'selected' : '' }}>🏁 Selesai (Program Berakhir)</option>
                            <option value="Dibatalkan" {{ old('status_kegiatan', $kegiatan->status_kegiatan) === 'Dibatalkan' ? 'selected' : '' }}>🔴 Dibatalkan</option>
                        </select>
                        @error('status_kegiatan')
                            <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul -->
                    <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                        <label for="judul_kegiatan" class="block text-sm font-bold text-gray-700 mb-2">Judul Program <span class="text-rose-500">*</span></label>
                        <input type="text" id="judul_kegiatan" name="judul_kegiatan" value="{{ old('judul_kegiatan', $kegiatan->judul_kegiatan) }}" 
                            class="input-premium w-full px-5 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] text-gray-800 text-lg font-semibold placeholder-gray-300 @error('judul_kegiatan') border-rose-400 @else border-gray-200 @enderror" required>
                        @error('judul_kegiatan')
                            <p class="text-xs text-rose-500 mt-2 font-semibold flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori & Kuota -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                            <label for="id_kategori" class="block text-sm font-bold text-gray-700 mb-2">Kategori <span class="text-rose-500">*</span></label>
                            <select id="id_kategori" name="id_kategori" 
                                class="input-premium w-full px-5 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] text-gray-700 font-medium @error('id_kategori') border-rose-400 @else border-gray-200 @enderror" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id_kategori }}" {{ old('id_kategori', $kegiatan->id_kategori) == $category->id_kategori ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                            <label for="kuota_relawan" class="block text-sm font-bold text-gray-700 mb-2">Kebutuhan Relawan <span class="text-rose-500">*</span></label>
                            <div class="relative">
                                <input type="number" id="kuota_relawan" name="kuota_relawan" value="{{ old('kuota_relawan', $kegiatan->kuota_relawan) }}" min="1"
                                    class="input-premium w-full pl-5 pr-16 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] text-gray-800 font-semibold @error('kuota_relawan') border-rose-400 @else border-gray-200 @enderror" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none">
                                    <span class="text-gray-400 font-bold text-sm">Orang</span>
                                </div>
                            </div>
                            @error('kuota_relawan')
                                <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Waktu Pelaksanaan -->
                    <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                        <h4 class="text-sm font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">Waktu Pelaksanaan <span class="text-rose-500">*</span></h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="tanggal_kegiatan" class="block text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Tanggal</label>
                                <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan) }}"
                                    class="input-premium w-full px-4 py-3 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] font-semibold text-gray-700 @error('tanggal_kegiatan') border-rose-400 @else border-gray-200 @enderror" required>
                                @error('tanggal_kegiatan')
                                    <p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="waktu_mulai" class="block text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Mulai</label>
                                <input type="time" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai', \Carbon\Carbon::parse($kegiatan->waktu_mulai)->format('H:i')) }}"
                                    class="input-premium w-full px-4 py-3 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] font-semibold text-gray-700 @error('waktu_mulai') border-rose-400 @else border-gray-200 @enderror" required>
                                @error('waktu_mulai')
                                    <p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="waktu_selesai" class="block text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Selesai</label>
                                <input type="time" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai', \Carbon\Carbon::parse($kegiatan->waktu_selesai)->format('H:i')) }}"
                                    class="input-premium w-full px-4 py-3 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] font-semibold text-gray-700 @error('waktu_selesai') border-rose-400 @else border-gray-200 @enderror" required>
                                @error('waktu_selesai')
                                    <p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi & Donasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                            <label for="lokasi" class="block text-sm font-bold text-gray-700 mb-2">Lokasi Kumpul / Pelaksanaan <span class="text-rose-500">*</span></label>
                            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}"
                                class="input-premium w-full px-5 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-gray-800 font-medium @error('lokasi') border-rose-400 @else border-gray-200 @enderror" required>
                            @error('lokasi')
                                <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-indigo-50/30 p-6 rounded-2xl border border-indigo-100/50">
                            <label for="target_donasi" class="block text-sm font-bold text-indigo-900 mb-2">Target Donasi <span class="text-xs text-indigo-400 font-normal">(Opsional)</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                                    <span class="text-indigo-400 font-bold">Rp</span>
                                </div>
                                <input type="number" id="target_donasi" name="target_donasi" value="{{ old('target_donasi', $kegiatan->target_donasi) }}" min="0" step="1000"
                                    class="input-premium w-full pl-12 pr-5 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-indigo-900 font-bold @error('target_donasi') border-rose-400 @else border-indigo-200 @enderror">
                            </div>
                            @error('target_donasi')
                                <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                        <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Program <span class="text-rose-500">*</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="6"
                            class="input-premium w-full px-5 py-4 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] text-gray-700 leading-relaxed @error('deskripsi') border-rose-400 @else border-gray-200 @enderror" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poster -->
                    <div class="bg-blue-50/30 p-6 rounded-2xl border border-blue-100/50">
                        <label for="poster_donasi" class="block text-sm font-bold text-blue-900 mb-4">Ganti Poster Campaign <span class="text-xs text-blue-400 font-normal">(Abaikan jika tidak ingin diganti)</span></label>
                        
                        <div class="flex flex-col md:flex-row gap-6 items-center">
                            @if ($kegiatan->poster_donasi)
                                <div class="shrink-0 p-2 bg-white rounded-xl shadow-sm border border-gray-200">
                                    <img src="{{ asset('storage/' . $kegiatan->poster_donasi) }}" alt="Poster Saat Ini" class="w-24 h-32 object-cover rounded-lg">
                                    <p class="text-[10px] text-center text-gray-500 font-bold mt-2">POSTER SAAT INI</p>
                                </div>
                            @endif

                            <div class="relative border-2 border-dashed border-blue-200 rounded-2xl bg-white p-6 text-center hover:bg-blue-50/50 transition-colors cursor-pointer group w-full h-full flex items-center justify-center min-h-[8rem]">
                                <input type="file" id="poster_donasi" name="poster_donasi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                                
                                <div class="flex flex-col items-center pointer-events-none">
                                    <div class="w-10 h-10 bg-blue-100 text-[#4379F2] rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-700">Pilih file poster baru</p>
                                </div>
                            </div>
                        </div>
                        @error('poster_donasi')
                            <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dokumentasi Foto (Wajib jika menandai Selesai) -->
                    <div class="bg-emerald-50/30 p-6 rounded-2xl border border-emerald-100/50">
                        <label for="dokumentasi_foto" class="block text-sm font-bold text-emerald-900 mb-4">Foto Dokumentasi (Wajib jika menandai <strong>Selesai</strong>)</label>
                        <div class="flex flex-col gap-6">
                            @php
                                $existingDocs = is_array($kegiatan->dokumentasi_foto) ? $kegiatan->dokumentasi_foto : ($kegiatan->dokumentasi_foto ? [$kegiatan->dokumentasi_foto] : []);
                            @endphp

                            @if(!empty($existingDocs))
                                <div class="flex flex-wrap gap-4">
                                    @foreach($existingDocs as $doc)
                                        <div class="shrink-0 p-2 bg-white rounded-xl shadow-sm border border-gray-200">
                                            <img src="{{ asset('storage/' . $doc) }}" alt="Dokumentasi" class="w-28 h-20 object-cover rounded-lg">
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-[10px] text-gray-500 font-bold -mt-4">DOKUMENTASI SAAT INI</p>
                            @endif

                            <div class="relative border-2 border-dashed border-emerald-100 rounded-2xl bg-white p-6 text-center hover:bg-emerald-50/50 transition-colors cursor-pointer group w-full flex items-center justify-center min-h-[8rem]">
                                <input type="file" id="dokumentasi_foto" name="dokumentasi_foto[]" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*" multiple>
                                <div class="flex flex-col items-center pointer-events-none">
                                    <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-700">Pilih file dokumentasi (Bisa lebih dari 1 file)</p>
                                    <p class="text-xs text-gray-500">PNG,JPG,WEBP up to 4MB per foto</p>
                                </div>
                            </div>
                        </div>
                        @error('dokumentasi_foto')
                            <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('koordinator.kegiatan.index') }}" class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition duration-200">
                            Batalkan Perubahan
                        </a>
                        <button type="submit" class="px-10 py-3.5 bg-gradient-to-r from-[#4379F2] to-blue-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all duration-300">
                            Simpan Pembaruan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Require dokumentasi_foto if status_kegiatan == 'Selesai' and no existing docs
        (function(){
            const statusSelect = document.getElementById('status_kegiatan');
            const docInput = document.getElementById('dokumentasi_foto');
            const hasExistingDocs = {{ !empty($existingDocs) ? 'true' : 'false' }};

            function toggleRequirement(){
                if(!statusSelect || !docInput) return;
                if(statusSelect.value === 'Selesai' && !hasExistingDocs){
                    docInput.required = true;
                } else {
                    docInput.required = false;
                }
            }

            statusSelect && statusSelect.addEventListener('change', toggleRequirement);
            document.addEventListener('DOMContentLoaded', toggleRequirement);
        })();
    </script>
</x-app-layout>
