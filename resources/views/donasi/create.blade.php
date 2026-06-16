<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Berdonasi untuk Kebaikan</h2>
        <p class="text-sm text-gray-500 font-medium">Anda akan berdonasi untuk kegiatan:</p>
        <p class="text-sm font-bold text-[#4379F2] line-clamp-1 mt-1">{{ $kegiatan->judul_kegiatan }}</p>
    </div>

    <!-- Alpine.js untuk mengatur jenis donasi secara interaktif -->
    <form method="POST" action="{{ route('donasi.store', $kegiatan->id_kegiatan) }}" enctype="multipart/form-data" class="space-y-6" x-data="{ jenis_donasi: 'Uang' }">
        @csrf

        <!-- Pilihan Jenis Donasi -->
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-3">Jenis Donasi</label>
            <div class="grid grid-cols-2 gap-4">
                <label class="relative flex cursor-pointer">
                    <input type="radio" name="jenis_donasi" value="Uang" x-model="jenis_donasi" class="peer sr-only">
                    <div class="w-full text-center px-4 py-3 rounded-xl border-2 border-gray-200 bg-white/50 text-gray-600 font-bold transition-all peer-checked:border-[#4379F2] peer-checked:bg-blue-50 peer-checked:text-[#4379F2]">
                        <svg class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Uang
                    </div>
                </label>

                <label class="relative flex cursor-pointer">
                    <input type="radio" name="jenis_donasi" value="Barang" x-model="jenis_donasi" class="peer sr-only">
                    <div class="w-full text-center px-4 py-3 rounded-xl border-2 border-gray-200 bg-white/50 text-gray-600 font-bold transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-600">
                        <svg class="w-6 h-6 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Barang
                    </div>
                </label>
            </div>
            @error('jenis_donasi')
                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <!-- Form Khusus Uang -->
        <div x-show="jenis_donasi === 'Uang'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
            <div>
                <label for="nominal_donasi" class="block text-sm font-bold text-gray-700 mb-1">Nominal Donasi (Rp)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 font-bold">Rp</span>
                    </div>
                    <input id="nominal_donasi" type="number" name="nominal_donasi" min="1000" class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-[#4379F2] focus:ring-4 focus:ring-blue-50 transition-all font-semibold" placeholder="Contoh: 50000" :required="jenis_donasi === 'Uang'">
                </div>
                @error('nominal_donasi')
                    <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Khusus Barang -->
        <div x-show="jenis_donasi === 'Barang'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
            <div>
                <label for="deskripsi_barang" class="block text-sm font-bold text-gray-700 mb-1">Nama / Deskripsi Barang</label>
                <input id="deskripsi_barang" type="text" name="deskripsi_barang" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all font-semibold" placeholder="Contoh: 1 Dus Mie Instan" :required="jenis_donasi === 'Barang'">
                @error('deskripsi_barang')
                    <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jumlah_barang" class="block text-sm font-bold text-gray-700 mb-1">Jumlah (Kuantitas)</label>
                <input id="jumlah_barang" type="number" name="jumlah_barang" min="1" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-emerald-500 focus:ring-4 focus:ring-emerald-50 transition-all font-semibold" placeholder="Contoh: 5" :required="jenis_donasi === 'Barang'">
                @error('jumlah_barang')
                    <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Bukti Gambar -->
        <div x-data="imageViewer()">
            <label class="block text-sm font-bold text-gray-700 mb-1" x-text="jenis_donasi === 'Uang' ? 'Unggah Bukti Transfer' : 'Unggah Foto Barang'"></label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-white/40 hover:bg-white/80 transition-colors relative cursor-pointer" @click="$refs.fileInput.click()">
                
                <div class="space-y-1 text-center" x-show="!imageUrl">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex justify-center text-sm text-gray-600 mt-2">
                        <span class="relative cursor-pointer bg-white rounded-md font-bold text-[#4379F2] focus-within:outline-none hover:text-blue-500">
                            Pilih file
                        </span>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, WEBP hingga 2MB</p>
                </div>

                <!-- Live Preview -->
                <div x-show="imageUrl" style="display: none;" class="w-full relative rounded-lg overflow-hidden">
                    <img :src="imageUrl" class="w-full h-40 object-cover" />
                    <button type="button" @click.stop="clearImage()" class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full shadow-md hover:bg-red-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <input type="file" x-ref="fileInput" name="bukti_donasi" accept="image/*" class="sr-only" @change="fileChosen" required>
            </div>
            @error('bukti_donasi')
                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-extrabold text-white bg-gradient-to-r from-[#4379F2] to-blue-600 hover:to-blue-700 hover:-translate-y-0.5 transition-all duration-200">
                Kirim Donasi Saya
            </button>
        </div>
    </form>

    <!-- Script for Live Image Preview -->
    <script>
        function imageViewer() {
            return {
                imageUrl: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },
                fileToDataUrl(event, callback) {
                    if (! event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()

                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
                clearImage() {
                    this.imageUrl = '';
                    this.$refs.fileInput.value = '';
                }
            }
        }
    </script>
</x-guest-layout>
