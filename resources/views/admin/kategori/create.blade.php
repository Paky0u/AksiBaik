<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.kategori.index') }}" class="p-2 bg-white rounded-full hover:bg-gray-50 transition-colors border border-gray-200 text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Tambah Kategori Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 overflow-hidden shadow-sm sm:rounded-[2rem] shadow-blue-900/5">
                <div class="p-8 md:p-10 text-gray-900">
                    
                    <form method="POST" action="{{ route('admin.kategori.store') }}" class="space-y-6">
                        @csrf

                        <!-- Nama Kategori -->
                        <div>
                            <label for="nama_kategori" class="block text-sm font-bold text-gray-700 mb-1">Nama Kategori <span class="text-rose-500">*</span></label>
                            <input id="nama_kategori" type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required autofocus class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-[#0ecedb] focus:ring-4 focus:ring-blue-50 transition-all font-semibold" placeholder="Contoh: Pendidikan, Lingkungan">
                            @error('nama_kategori')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-1">Deskripsi <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-[#0ecedb] focus:ring-4 focus:ring-blue-50 transition-all text-gray-600" placeholder="Berikan penjelasan singkat mengenai kategori ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4 flex items-center justify-end gap-3">
                            <a href="{{ route('admin.kategori.index') }}" class="px-6 py-3 rounded-xl text-gray-600 font-bold hover:bg-gray-100 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-[#0ecedb] to-blue-600 text-white font-extrabold rounded-xl shadow-lg shadow-blue-500/30 hover:-translate-y-0.5 transition-all duration-200">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
