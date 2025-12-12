@extends('layouts.app')

@section('title', 'Login - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <div class="w-20 h-20 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Login Required</h1>
                <p class="text-gray-300 text-lg">Silakan login dengan Gmail untuk melakukan booking</p>
                <div class="flex justify-center mt-6">
                    <div class="w-24 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Login Card -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-white mb-2">Masuk ke Akun Anda</h2>
                    <p class="text-gray-400">Gunakan akun Gmail untuk booking appointment</p>
                </div>

                <!-- Google Login Button -->
                <div class="space-y-4">
                    <a href="{{ route('auth.google') }}" 
                       class="w-full flex items-center justify-center px-6 py-4 bg-white hover:bg-gray-50 text-gray-900 font-semibold rounded-xl transition-colors border border-gray-300 shadow-sm">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Masuk dengan Google
                    </a>
                </div>

                <!-- Info Box -->
                <div class="mt-6 p-4 bg-blue-500/10 border border-blue-500/30 rounded-xl">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-blue-400 font-semibold mb-1">Mengapa perlu login?</h3>
                            <ul class="text-gray-300 text-sm space-y-1">
                                <li>• Untuk keamanan data booking Anda</li>
                                <li>• Memudahkan tracking status appointment</li>
                                <li>• Menyimpan riwayat booking</li>
                                <li>• Notifikasi konfirmasi via email</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Privacy Notice -->
                <div class="mt-4 text-center">
                    <p class="text-gray-400 text-xs">
                        Dengan login, Anda menyetujui 
                        <a href="#" class="text-yellow-400 hover:text-yellow-300">Syarat & Ketentuan</a> 
                        dan 
                        <a href="#" class="text-yellow-400 hover:text-yellow-300">Kebijakan Privasi</a> kami
                    </p>
                </div>

                <!-- Test Login Link (Development Only) -->
                <div class="mt-4 text-center">
                    <a href="{{ route('auth.test-login') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                        Test Login (Development)
                    </a>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="/" 
                   class="inline-block px-8 py-3 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection