<x-app-layout>
    <style>
        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 1.5rem;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px -10px rgba(0,0,0,0.08);
        }
        .input-premium {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            background: rgba(255, 255, 255, 0.5);
            transition: all 0.2s;
        }
        .input-premium:focus {
            background: white;
            outline: none;
            border-color: #0ecedb;
            box-shadow: 0 0 0 4px rgba(67, 121, 242, 0.1);
        }
    </style>

    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <h2 class="font-extrabold text-2xl text-gray-900 tracking-tight">
                {{ __('Pengaturan Profil') }}
            </h2>
        </div>
    </x-slot>

    <div class="relative py-12 min-h-screen overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-br from-purple-100 to-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -z-10 translate-x-1/3 -translate-y-1/4"></div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">
            <!-- Profile Info -->
            <div class="profile-card p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Password -->
            <div class="profile-card p-8">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="profile-card p-8 border-rose-100 bg-gradient-to-br from-white to-rose-50/30">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
