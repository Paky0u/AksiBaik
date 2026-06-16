<section class="space-y-6">
    <header class="mb-6 border-b border-rose-100 pb-4">
        <h2 class="text-xl font-bold text-rose-600 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Akun Permanen
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus, harap unduh data apa pun yang ingin Anda simpan.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-6 py-2.5 bg-rose-50 border border-rose-200 text-rose-600 hover:bg-rose-600 hover:text-white text-sm font-bold rounded-xl shadow-sm transition duration-150"
    >
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-extrabold text-gray-900 mb-2">
                Apakah Anda yakin ingin menghapus akun ini?
            </h2>

            <p class="text-sm text-gray-600 mb-6 bg-rose-50 p-3 rounded-lg border border-rose-100">
                Tindakan ini tidak dapat dibatalkan. Semua data terkait donasi dan kerelawanan Anda akan terhapus. Masukkan sandi Anda untuk konfirmasi.
            </p>

            <div>
                <label for="password" class="sr-only">Kata Sandi</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="input-premium w-full"
                    placeholder="Masukkan Kata Sandi Anda"
                />
                @error('password', 'userDeletion')
                    <p class="text-xs text-rose-500 mt-2 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-xl transition duration-150">
                    Batal
                </button>

                <button type="submit" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-sm font-bold rounded-xl shadow-md transition duration-150">
                    Ya, Hapus Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>
