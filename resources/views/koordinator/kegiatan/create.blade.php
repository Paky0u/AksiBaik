<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Kegiatan Sosial Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Back to Dashboard -->
            <div class="mb-6">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-[#4379F2] transition-colors">
                    <svg class="w-5 h-5 me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-6 md:p-8">
                <div class="border-b border-gray-100 pb-5 mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Formulir Kegiatan Sosial</h3>
                    <p class="text-sm text-gray-500 mt-1">Lengkapi informasi di bawah ini untuk mempublikasikan program baru bagi relawan dan donatur.</p>
                </div>

                <!-- Formulir Input -->
                <form action="{{ route('koordinator.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Judul Kegiatan (150 Karakter) -->
                    <div>
                        <label for="judul_kegiatan" class="block text-sm font-bold text-gray-700 mb-1">Judul Kegiatan <span class="text-rose-500">*</span></label>
                        <input type="text" id="judul_kegiatan" name="judul_kegiatan" value="{{ old('judul_kegiatan') }}" 
                            class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('judul_kegiatan') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror"
                            placeholder="Contoh: Mengajar Anak Jalanan di Kolong Jembatan" required>
                        @error('judul_kegiatan')
                            <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori Kegiatan -->
                        <div>
                            <label for="id_kategori" class="block text-sm font-bold text-gray-700 mb-1">Kategori Kegiatan <span class="text-rose-500">*</span></label>
                            <select id="id_kategori" name="id_kategori" 
                                class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('id_kategori') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id_kategori }}" {{ old('id_kategori') == $category->id_kategori ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kuota Relawan -->
                        <div>
                            <label for="kuota_relawan" class="block text-sm font-bold text-gray-700 mb-1">Kuota Relawan (Orang) <span class="text-rose-500">*</span></label>
                            <input type="number" id="kuota_relawan" name="kuota_relawan" value="{{ old('kuota_relawan') }}" min="1"
                                class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('kuota_relawan') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror"
                                placeholder="Contoh: 15" required>
                            @error('kuota_relawan')
                                <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi Kegiatan -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Kegiatan <span class="text-rose-500">*</span></label>
                        <textarea id="deskripsi" name="deskripsi" rows="5"
                            class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('deskripsi') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror"
                            placeholder="Deskripsikan agenda, sasaran, dan ketentuan kegiatan secara jelas agar relawan mudah memahaminya..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi Kegiatan (150 Karakter) -->
                    <div>
                        <label for="lokasi" class="block text-sm font-bold text-gray-700 mb-1">Lokasi Kegiatan <span class="text-rose-500">*</span></label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('lokasi') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror"
                            placeholder="Contoh: Jl. Kemanusiaan No. 12, Grogol, Jakarta Barat" required>
                        @error('lokasi')
                            <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Tanggal Kegiatan -->
                        <div>
                            <label for="tanggal_kegiatan" class="block text-sm font-bold text-gray-700 mb-1">Tanggal Kegiatan <span class="text-rose-500">*</span></label>
                            <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
                                class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('tanggal_kegiatan') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror" required>
                            @error('tanggal_kegiatan')
                                <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Mulai -->
                        <div>
                            <label for="waktu_mulai" class="block text-sm font-bold text-gray-700 mb-1">Waktu Mulai <span class="text-rose-500">*</span></label>
                            <input type="time" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('waktu_mulai') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror" required>
                            @error('waktu_mulai')
                                <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Selesai -->
                        <div>
                            <label for="waktu_selesai" class="block text-sm font-bold text-gray-700 mb-1">Waktu Selesai <span class="text-rose-500">*</span></label>
                            <input type="time" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}"
                                class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('waktu_selesai') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror" required>
                            @error('waktu_selesai')
                                <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Target Donasi (Opsional) -->
                        <div>
                            <label for="target_donasi" class="block text-sm font-bold text-gray-700 mb-1">Target Donasi Dana (Rp) <span class="text-xs text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="number" id="target_donasi" name="target_donasi" value="{{ old('target_donasi') }}" min="0" step="1000"
                                class="w-full px-4 py-2.5 border rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition duration-150 @error('target_donasi') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @else border-gray-300 @enderror"
                                placeholder="Contoh: 10000000">
                            @error('target_donasi')
                                <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Poster Kegiatan (Opsional) -->
                        <div>
                            <label for="poster_donasi" class="block text-sm font-bold text-gray-700 mb-1">Upload Poster Kegiatan <span class="text-xs text-gray-400 font-normal">(Opsional, max 2MB)</span></label>
                            <input type="file" id="poster_donasi" name="poster_donasi"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-[#4379F2] hover:file:bg-blue-100 border border-gray-300 rounded-xl cursor-pointer p-1 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4379F2]/20 transition duration-150 @error('poster_donasi') border-rose-400 focus:ring-rose-200 focus:border-rose-400 @enderror">
                            @error('poster_donasi')
                                <p class="text-xs text-rose-500 mt-1.5 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-6">
                        <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition duration-150">
                            Batal
                        </a>
                        <!-- Submit Button warna #4379F2 -->
                        <button type="submit" class="px-8 py-2.5 bg-[#4379F2] hover:bg-blue-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition duration-150 transform hover:-translate-y-0.5">
                            Simpan & Publikasikan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
