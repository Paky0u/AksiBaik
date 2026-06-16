<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.pengguna.index') }}" class="p-2 bg-white rounded-full hover:bg-gray-50 transition-colors border border-gray-200 text-gray-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Edit Profil & Peran Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 overflow-hidden shadow-sm sm:rounded-[2rem] shadow-blue-900/5">
                <div class="p-8 md:p-10 text-gray-900">
                    
                    <div class="flex items-center gap-5 mb-8 pb-8 border-b border-gray-100">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center text-indigo-700 font-extrabold text-2xl shadow-inner">
                            {{ strtoupper(substr($pengguna->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $pengguna->name }}</h3>
                            <p class="text-gray-500 text-sm">Bergabung sejak {{ \Carbon\Carbon::parse($pengguna->created_at)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.pengguna.update', $pengguna->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Role / Peran -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Peran (Role) Akses Aplikasi <span class="text-rose-500">*</span></label>
                            
                            @if($pengguna->id === auth()->id())
                                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl mb-2">
                                    <p class="text-sm text-yellow-800 font-semibold flex items-center gap-2">
                                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        Anda sedang mengedit akun Anda sendiri.
                                    </p>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="role" value="relawan" class="peer sr-only" {{ old('role', $pengguna->role) == 'relawan' ? 'checked' : '' }}>
                                    <div class="w-full text-center px-4 py-3 rounded-xl border-2 border-gray-200 bg-white/50 text-gray-600 font-bold transition-all peer-checked:border-[#4379F2] peer-checked:bg-blue-50 peer-checked:text-[#4379F2] hover:bg-gray-50">
                                        Relawan
                                    </div>
                                </label>
                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="role" value="koordinator" class="peer sr-only" {{ old('role', $pengguna->role) == 'koordinator' ? 'checked' : '' }}>
                                    <div class="w-full text-center px-4 py-3 rounded-xl border-2 border-gray-200 bg-white/50 text-gray-600 font-bold transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 hover:bg-gray-50">
                                        Koordinator
                                    </div>
                                </label>
                                <label class="relative flex cursor-pointer">
                                    <input type="radio" name="role" value="admin" class="peer sr-only" {{ old('role', $pengguna->role) == 'admin' ? 'checked' : '' }}>
                                    <div class="w-full text-center px-4 py-3 rounded-xl border-2 border-gray-200 bg-white/50 text-gray-600 font-bold transition-all peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:text-rose-700 hover:bg-gray-50">
                                        Admin
                                    </div>
                                </label>
                            </div>
                            @error('role')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                            <input id="name" type="text" name="name" value="{{ old('name', $pengguna->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-[#4379F2] focus:ring-4 focus:ring-blue-50 transition-all font-semibold">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Alamat Email <span class="text-rose-500">*</span></label>
                            <input id="email" type="email" name="email" value="{{ old('email', $pengguna->email) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-[#4379F2] focus:ring-4 focus:ring-blue-50 transition-all font-semibold">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-bold text-gray-700 mb-1">Nomor Telepon/WhatsApp <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input id="telepon" type="text" name="telepon" value="{{ old('telepon', $pengguna->telepon) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-[#4379F2] focus:ring-4 focus:ring-blue-50 transition-all font-semibold">
                            @error('telepon')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3 mt-8">
                            <a href="{{ route('admin.pengguna.index') }}" class="px-6 py-3 rounded-xl text-gray-600 font-bold hover:bg-gray-100 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-extrabold rounded-xl shadow-lg shadow-emerald-500/30 hover:-translate-y-0.5 transition-all duration-200">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
