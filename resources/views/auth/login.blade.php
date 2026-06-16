<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-extrabold text-gray-900">Selamat Datang Kembali! 👋</h2>
        <p class="text-sm text-gray-500 mt-2">Masuk ke akun Anda untuk melanjutkan aksi baik hari ini.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Anda</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition-all duration-200 outline-none @error('email') border-rose-400 focus:ring-rose-200 @enderror" placeholder="nama@email.com">
            @error('email')
                <p class="text-xs text-rose-500 mt-1.5 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-bold text-gray-700">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#4379F2] hover:text-blue-700 transition-colors">Lupa sandi?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#4379F2]/20 focus:border-[#4379F2] transition-all duration-200 outline-none @error('password') border-rose-400 focus:ring-rose-200 @enderror" placeholder="••••••••">
            @error('password')
                <p class="text-xs text-rose-500 mt-1.5 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-[#4379F2] bg-white border-gray-300 rounded focus:ring-[#4379F2] focus:ring-2">
            <label for="remember_me" class="ml-2 text-sm font-medium text-gray-600">Ingat saya</label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-[#4379F2] to-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transition-all duration-300 mt-2">
            Masuk Sekarang
        </button>
        
        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-[#4379F2] hover:underline">Daftar di sini</a>
        </p>
    </form>
</x-guest-layout>
