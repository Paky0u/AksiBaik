<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900">Bergabung Bersama Kami ✨</h2>
        <p class="text-sm text-gray-500 mt-2">Daftar sekarang dan mulai sebarkan kebaikan ke seluruh penjuru.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition-all duration-200 outline-none @error('name') border-rose-400 focus:ring-rose-200 @enderror" placeholder="Budi Santoso">
            @error('name')
                <p class="text-xs text-rose-500 mt-1.5 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition-all duration-200 outline-none @error('email') border-rose-400 focus:ring-rose-200 @enderror" placeholder="budi@email.com">
            @error('email')
                <p class="text-xs text-rose-500 mt-1.5 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Kata Sandi</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition-all duration-200 outline-none @error('password') border-rose-400 focus:ring-rose-200 @enderror" placeholder="Min. 8 karakter">
            @error('password')
                <p class="text-xs text-rose-500 mt-1.5 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition-all duration-200 outline-none @error('password_confirmation') border-rose-400 focus:ring-rose-200 @enderror" placeholder="Ulangi kata sandi">
            @error('password_confirmation')
                <p class="text-xs text-rose-500 mt-1.5 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-bold text-gray-700 mb-1">Pilih Peran</label>
            <select id="role" name="role" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition-all duration-200 outline-none @error('role') border-rose-400 @enderror">
                <option value="Relawan" {{ old('role') === 'Relawan' ? 'selected' : '' }}>Relawan</option>
                <option value="Kontributor" {{ old('role') === 'Kontributor' ? 'selected' : '' }}>Kontributor</option>
            </select>
            @error('role')
                <p class="text-xs text-rose-500 mt-1.5 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#6EC207] to-emerald-600 text-white font-bold rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 transition-all duration-300 mt-6">
            Buat Akun Saya
        </button>
        
        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-[#4379F2] hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>
