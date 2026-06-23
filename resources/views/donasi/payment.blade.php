@php
    $midtransScript = config('services.midtrans.is_production')
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js';
@endphp

<x-guest-layout>
    <div class="max-w-3xl mx-auto p-6">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Pembayaran Donasi</h2>
            <p class="text-sm text-gray-500">Lanjutkan pembayaran donasi untuk kegiatan:</p>
            <p class="text-sm font-bold text-[#0ecedb] mt-1">{{ $kegiatan->judul_kegiatan ?? $kegiatan->nama_kegiatan ?? 'Kegiatan' }}</p>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500">Nominal Donasi</p>
                    <p class="text-2xl font-extrabold text-gray-900">Rp {{ number_format($donasi->nominal_donasi, 0, ',', '.') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-500">ID Donasi</p>
                    <p class="font-mono text-sm text-gray-700">{{ $donasi->id_donasi }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <button id="pay-button" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-extrabold text-white bg-gradient-to-r from-[#0ecedb] to-blue-600 hover:to-blue-700 hover:-translate-y-0.5 transition-all duration-200">
                Bayar Sekarang
            </button>

            <a href="{{ route('kegiatan.show', $donasi->id_kegiatan) }}" class="block text-center text-sm text-gray-600 hover:text-gray-800">Batal dan kembali ke detail kegiatan</a>
        </div>
    </div>

    <script src="{{ $midtransScript }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        const snapToken = "{{ $snapToken }}";
        const donasiId = {{ $donasi->id_donasi }};

        document.getElementById('pay-button').addEventListener('click', function () {
            window.snap.pay(snapToken, {
                onSuccess: function (result) {
                    sendResult(result);
                },
                onPending: function (result) {
                    sendResult(result);
                },
                onError: function (result) {
                    sendResult(result);
                },
                onClose: function () {
                    alert('Anda menutup halaman pembayaran tanpa menyelesaikan transaksi.');
                }
            });
        });

        function sendResult(result) {
            fetch("{{ route('donasi.midtrans.finish', ['id' => $donasi->id_donasi]) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ result_data: JSON.stringify(result) })
            }).then(res => res.json()).then(data => {
                if (data.success) {
                    window.location.href = "{{ route('kegiatan.show', $donasi->id_kegiatan) }}" + '?success=paid';
                } else {
                    window.location.href = "{{ route('kegiatan.show', $donasi->id_kegiatan) }}" + '?error=payment_failed';
                }
            }).catch(err => {
                console.error(err);
                window.location.href = "{{ route('kegiatan.show', $donasi->id_kegiatan) }}" + '?error=network';
            });
        }
    </script>
</x-guest-layout>
