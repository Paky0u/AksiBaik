<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
            {{ __('Feedback & Penilaian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 sm:p-10">
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-blue-600 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Penilaian Kegiatan</h3>
                        <p class="text-gray-500 mt-2">Bagaimana pengalaman Anda mengikuti <strong>{{ $kegiatan->judul_kegiatan }}</strong>?</p>
                    </div>

                    <form action="{{ route('relawan.feedback.store', $kegiatan->id_kegiatan) }}" method="POST">
                        @csrf
                        
                        <!-- Penilaian -->
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-3 text-center">Seberapa puas Anda dengan kegiatan ini? (1 = Sangat Buruk, 10 = Sangat Baik)</label>
                            <div class="flex flex-wrap justify-center gap-2">
                                @for($i = 1; $i <= 10; $i++)
                                    <div class="relative">
                                        <input class="peer sr-only" type="radio" value="{{ $i }}" name="penilaian" id="rating_{{ $i }}" required>
                                        <label class="flex items-center justify-center w-10 h-10 rounded-full border-2 border-gray-200 bg-white text-gray-600 font-semibold cursor-pointer transition-all peer-hover:border-blue-500 peer-hover:text-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-600 peer-checked:text-white shadow-sm" for="rating_{{ $i }}">
                                            {{ $i }}
                                        </label>
                                    </div>
                                @endfor
                            </div>
                            @error('penilaian')
                                <p class="text-red-500 text-xs italic mt-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Komentar -->
                        <div class="mb-6">
                            <label for="komentar" class="block text-sm font-bold text-gray-700 mb-2">Komentar / Ulasan Singkat</label>
                            <textarea id="komentar" name="komentar" rows="4" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-4 transition-colors hover:bg-white" placeholder="Ceritakan pengalaman Anda, apa yang berkesan, atau saran untuk kedepannya..."></textarea>
                            @error('komentar')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end gap-4 mt-8">
                            <a href="{{ route('relawan.riwayat') }}" class="px-6 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-8 py-2.5 bg-blue-600 border border-transparent rounded-full font-bold text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Kirim Penilaian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
