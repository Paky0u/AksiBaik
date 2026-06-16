<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sertifikat - {{ $pendaftaran->relawan->name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .certificate-wrapper {
            width: 1123px; /* A4 Landscape width at 96 PPI */
            height: 794px; /* A4 Landscape height at 96 PPI */
            background-color: white;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%234379F2" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
            z-index: 1;
        }

        .border-decoration {
            position: absolute;
            top: 30px;
            left: 30px;
            right: 30px;
            bottom: 30px;
            border: 2px solid #E5E7EB;
            z-index: 2;
        }

        .border-decoration::before {
            content: '';
            position: absolute;
            top: -10px; left: -10px; right: -10px; bottom: -10px;
            border: 4px solid #4379F2;
            opacity: 0.1;
        }

        .corner-tl { position: absolute; top: 0; left: 0; width: 150px; height: 150px; background: radial-gradient(circle at top left, rgba(67, 121, 242, 0.2), transparent 70%); z-index: 2; }
        .corner-br { position: absolute; bottom: 0; right: 0; width: 250px; height: 250px; background: radial-gradient(circle at bottom right, rgba(110, 194, 7, 0.2), transparent 70%); z-index: 2; }

        .content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 0 80px;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            color: #4379F2;
            margin-bottom: 20px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 64px;
            color: #111827;
            margin: 0 0 30px 0;
            font-style: italic;
        }

        p.subtitle {
            font-size: 18px;
            color: #4B5563;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 40px;
        }

        .recipient-name {
            font-family: 'Playfair Display', serif;
            font-size: 56px;
            color: #4379F2;
            margin: 0 0 20px 0;
            font-weight: 700;
            border-bottom: 2px solid #E5E7EB;
            display: inline-block;
            padding: 0 40px 10px 40px;
        }

        .description {
            font-size: 18px;
            color: #4B5563;
            max-width: 800px;
            margin: 0 auto 50px auto;
            line-height: 1.6;
        }

        .kegiatan-title {
            font-weight: 800;
            color: #111827;
        }

        .footer {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-top: 40px;
        }

        .signature-block {
            text-align: center;
        }

        .signature-line {
            width: 200px;
            border-bottom: 1px solid #111827;
            margin: 0 auto 10px auto;
        }

        .date-badge {
            display: inline-block;
            background-color: #F3F4F6;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            .certificate-wrapper {
                box-shadow: none;
                border-radius: 0;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: A4 landscape;
                margin: 0;
            }
        }

        .action-buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 50;
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>

    <div class="action-buttons no-print">
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-white text-gray-700 rounded-lg shadow-md font-bold text-sm hover:bg-gray-50 transition-colors">
            Kembali
        </a>
        <button onclick="window.print()" class="px-6 py-2 bg-[#4379F2] text-white rounded-lg shadow-md font-bold text-sm hover:bg-blue-700 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="certificate-wrapper">
        <div class="bg-pattern"></div>
        <div class="border-decoration"></div>
        <div class="corner-tl"></div>
        <div class="corner-br"></div>

        <div class="content">
            <div class="logo">AksiBaik</div>
            <p class="subtitle">Sertifikat Apresiasi</p>
            <h1>Sertifikat Penghargaan</h1>
            
            <p class="text-gray-500 mb-6 font-medium">Diberikan dengan rasa bangga kepada:</p>
            
            <h2 class="recipient-name">{{ $pendaftaran->relawan->name }}</h2>
            
            <p class="description">
                Atas dedikasi, waktu, dan tenaga yang luar biasa sebagai Relawan dalam menyukseskan program kebaikan:<br>
                <span class="kegiatan-title text-2xl mt-4 block">"{{ $pendaftaran->kegiatanSosial->judul_kegiatan }}"</span>
            </p>

            <div class="footer">
                <div class="signature-block">
                    <p class="font-bold text-gray-800 mb-8 pb-4">Koordinator Program</p>
                    <div class="signature-line"></div>
                    <p class="text-sm text-gray-500 font-medium">Penyelenggara AksiBaik</p>
                </div>

                <div class="signature-block flex flex-col justify-end pb-4">
                    <div class="date-badge mb-2">
                        Ditetapkan pada: {{ \Carbon\Carbon::parse($pendaftaran->kegiatanSosial->tanggal_kegiatan)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
