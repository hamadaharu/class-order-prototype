<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ruang Kelas') }} - Booking System</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-gray-900 bg-slate-50 selection:bg-indigo-500 selection:text-white">
    
    <!-- Navigation -->
    <nav class="absolute w-full z-50 px-6 py-4 flex justify-between items-center max-w-7xl mx-auto inset-x-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <span class="text-2xl font-black tracking-tight text-slate-800">Ruang<span class="text-indigo-600">Kelas</span></span>
        </div>
        <div>
            @if (Route::has('login'))
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition px-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 hidden sm:inline-block">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-gradient-to-br from-indigo-300 to-purple-300 blur-3xl opacity-50 animate-blob"></div>
            <div class="absolute top-[20%] -right-[10%] w-[35%] h-[35%] rounded-full bg-gradient-to-bl from-blue-300 to-cyan-300 blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-[10%] left-[20%] w-[50%] h-[50%] rounded-full bg-gradient-to-tr from-pink-300 to-indigo-300 blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
            <div class="absolute inset-0 bg-white/40 backdrop-blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-20 pb-16 text-center lg:pt-32 relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50/80 border border-indigo-100 text-indigo-700 text-sm font-bold mb-8 shadow-sm backdrop-blur-sm">
                <span class="flex h-2.5 w-2.5 rounded-full bg-indigo-600 animate-pulse"></span>
                Sistem Terpadu Manajemen Ruangan
            </div>
            
            <h1 class="mx-auto max-w-4xl font-black text-5xl tracking-tight text-slate-900 sm:text-7xl mb-8 leading-tight">
                Pesan ruang kelas dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">mudah & cepat.</span>
            </h1>
            
            <p class="mx-auto max-w-2xl text-lg text-slate-600 mb-10 leading-relaxed font-medium">
                Platform modern untuk dosen dan mahasiswa mengelola pemesanan ruang kelas. Cek ketersediaan secara real-time, ajukan pemesanan, dan dapatkan persetujuan dengan instan.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:shadow-2xl hover:shadow-indigo-300 transition-all transform hover:-translate-y-1">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl shadow-xl shadow-indigo-200 hover:shadow-2xl hover:shadow-indigo-300 transition-all transform hover:-translate-y-1 text-lg">
                        Mulai Booking
                    </a>
                    <a href="#features" class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-2xl shadow-md border border-slate-100 transition-all text-lg">
                        Pelajari Fitur
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-slate-900">Mengapa RuangKelas?</h2>
                <p class="mt-4 text-xl text-slate-500 font-medium">Fitur unggulan untuk kelancaran aktivitas akademik Anda.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-3xl p-10 border border-slate-100 hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Real-time Schedule</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Cek ketersediaan ruangan secara real-time. Tidak ada lagi resiko double-booking saat akan mengajar atau acara.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-3xl p-10 border border-slate-100 hover:shadow-xl hover:border-purple-200 transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Fast Approval</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Proses persetujuan (approval) yang cepat oleh Admin dengan pemantauan status pesanan di dashboard Anda.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-3xl p-10 border border-slate-100 hover:shadow-xl hover:border-pink-200 transition-all duration-300 transform hover:-translate-y-2 group">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Role-based Access</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Hak akses tersistemasi untuk Admin, Dosen, dan Mahasiswa memastikan pengelolaan ruangan aman dan tertib.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-slate-900 py-16 text-center text-slate-400">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <span class="text-2xl font-black tracking-tight text-white">RuangKelas</span>
            </div>
            <p class="font-medium text-slate-500">&copy; {{ date('Y') }} Aplikasi Manajemen Ruang Kelas. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
