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
        /* Hide scrollbar for a cleaner look in textarea if wanted */
    </style>

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-[#6EC207]/10 text-[#6EC207] rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            </div>
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Rancang Program Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="relative min-h-screen py-10 overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-br from-emerald-100 to-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -z-10 translate-x-1/3 -translate-y-1/4"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <a href="{{ route('koordinator.kegiatan.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100 text-sm font-bold text-gray-600 hover:text-[#4379F2] mb-8 hover:-translate-x-1 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>

            <div class="glass-card rounded-[2rem] shadow-xl shadow-blue-900/5 overflow-hidden">
                <div class="px-8 py-6 bg-white/50 border-b border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900">Formulir Pendaftaran Kegiatan</h3>
                    <p class="text-sm text-gray-500 mt-1">Lengkapi detail di bawah ini agar relawan tertarik untuk bergabung dengan inisiatif Anda.</p>
                </div>

                <form action="{{ route('koordinator.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                    @csrf

                    <!-- Judul -->
                    <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                        <label for="judul_kegiatan" class="block text-sm font-bold text-gray-700 mb-2">Apa nama program sosial ini? <span class="text-rose-500">*</span></label>
                        <input type="text" id="judul_kegiatan" name="judul_kegiatan" value="{{ old('judul_kegiatan') }}" 
                            class="input-premium w-full px-5 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] text-gray-800 text-lg font-semibold placeholder-gray-300 @error('judul_kegiatan') border-rose-400 @else border-gray-200 @enderror"
                            placeholder="Contoh: Mengajar Anak Jalanan di Kolong Jembatan" required>
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
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id_kategori }}" {{ old('id_kategori') == $category->id_kategori ? 'selected' : '' }}>
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
                                <input type="number" id="kuota_relawan" name="kuota_relawan" value="{{ old('kuota_relawan') }}" min="1"
                                    class="input-premium w-full pl-5 pr-16 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] text-gray-800 font-semibold @error('kuota_relawan') border-rose-400 @else border-gray-200 @enderror"
                                    placeholder="0" required>
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
                                <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                                    class="input-premium w-full px-4 py-3 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] font-semibold text-gray-700 @error('tanggal_kegiatan') border-rose-400 @else border-gray-200 @enderror" required>
                                @error('tanggal_kegiatan')
                                    <p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="waktu_mulai" class="block text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Mulai</label>
                                <input type="time" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                    class="input-premium w-full px-4 py-3 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] font-semibold text-gray-700 @error('waktu_mulai') border-rose-400 @else border-gray-200 @enderror" required>
                                @error('waktu_mulai')
                                    <p class="text-[10px] text-rose-500 mt-1 font-bold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="waktu_selesai" class="block text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wider">Selesai</label>
                                <input type="time" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}"
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
                            <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                                class="input-premium w-full px-5 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-gray-800 font-medium placeholder-gray-300 @error('lokasi') border-rose-400 @else border-gray-200 @enderror"
                                placeholder="Detail alamat lokasi..." required>
                            @error('lokasi')
                                <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-indigo-50/30 p-6 rounded-2xl border border-indigo-100/50">
                            <label for="target_donasi" class="block text-sm font-bold text-indigo-900 mb-2">Target Donasi <span class="text-xs text-indigo-400 font-normal">(Kosongkan jika tidak ada)</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                                    <span class="text-indigo-400 font-bold">Rp</span>
                                </div>
                                <input type="number" id="target_donasi" name="target_donasi" value="{{ old('target_donasi') }}" min="0" step="1000"
                                    class="input-premium w-full pl-12 pr-5 py-3.5 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 text-indigo-900 font-bold placeholder-indigo-200 @error('target_donasi') border-rose-400 @else border-indigo-200 @enderror"
                                    placeholder="1000000">
                            </div>
                            @error('target_donasi')
                                <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100/50">
                        <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">Ceritakan Tentang Program Ini <span class="text-rose-500">*</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="6"
                            class="input-premium w-full px-5 py-4 bg-white border rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] text-gray-700 leading-relaxed placeholder-gray-300 @error('deskripsi') border-rose-400 @else border-gray-200 @enderror"
                            placeholder="Tuliskan latar belakang, tujuan, aktivitas yang akan dilakukan relawan, serta perlengkapan yang perlu dibawa..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poster -->
                    <div class="bg-blue-50/30 p-6 rounded-2xl border border-blue-100/50">
                        <label for="poster_donasi" class="block text-sm font-bold text-blue-900 mb-3">Unggah Poster Campaign <span class="text-xs text-blue-400 font-normal">(Opsional, max 2MB)</span></label>
                        
                        <div class="relative border-2 border-dashed border-blue-200 rounded-2xl bg-white p-8 text-center hover:bg-blue-50/50 transition-colors cursor-pointer group">
                            <input type="file" id="poster_donasi" name="poster_donasi" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
                            
                            <div class="flex flex-col items-center pointer-events-none">
                                <div class="w-16 h-16 bg-blue-100 text-[#4379F2] rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <p class="text-sm font-bold text-gray-700">Klik atau tarik file gambar ke sini</p>
                                <p class="text-xs text-gray-400 mt-1">Format didukung: JPG, PNG, GIF</p>
                            </div>
                        </div>
                        @error('poster_donasi')
                            <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('koordinator.kegiatan.index') }}" class="px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition duration-200">
                            Batal
                        </a>
                        <button type="submit" class="px-10 py-3.5 bg-gradient-to-r from-[#6EC207] to-emerald-600 text-white text-sm font-bold rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300">
                            Publikasikan Program
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
