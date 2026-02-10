<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Perpus') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        primary: '#0f172a', // Slate 900 (Deep Navy)
                        secondary: '#1e293b', // Slate 800
                        gold: '#d4af37',     // Luxury Gold
                        goldlight: '#fcd34d',
                    }
                }
            }
        }
    </script>
    <style>
        /* Animasi Background Halus */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        .glass-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="bg-primary text-slate-300 font-sans antialiased selection:bg-gold selection:text-primary overflow-x-hidden min-h-screen flex flex-col relative">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-900/30 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-gold/10 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-purple-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/noise.png')] opacity-[0.03]"></div>
    </div>

    <nav class="relative z-50 w-full px-6 py-6 lg:px-12 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-gold to-yellow-700 flex items-center justify-center text-primary shadow-lg shadow-gold/20">
                <i class="fas fa-book-open text-lg"></i>
            </div>
            <div>
                <h1 class="font-serif text-2xl font-bold text-white tracking-wide">E-Perpus</h1>
            </div>
        </div>

        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-white hover:text-gold transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-medium text-slate-300 hover:text-white transition-colors px-4 py-2">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hidden sm:inline-block px-6 py-2.5 rounded-full bg-white text-primary font-bold text-sm hover:bg-gold transition-all duration-300 shadow-[0_0_15px_rgba(255,255,255,0.2)] hover:shadow-[0_0_20px_rgba(212,175,55,0.4)]">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="relative z-10 flex-1 flex flex-col justify-center items-center px-6 lg:px-8 py-12 text-center">
        
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card mb-8 animate-fade-in-down">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            <span class="text-xs font-semibold text-gold uppercase tracking-[0.2em]">Perpustakaan Digital Terintegrasi</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-serif font-bold text-white mb-6 leading-tight max-w-4xl">
            Jendela Dunia dalam <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold via-yellow-200 to-gold italic">Genggaman Anda</span>
        </h1>

        <p class="text-lg text-slate-400 mb-10 max-w-2xl leading-relaxed">
            Akses ribuan koleksi buku digital berkualitas tinggi, jurnal akademik, dan literatur modern dengan antarmuka yang elegan dan profesional.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-gradient-to-r from-gold to-yellow-600 rounded-full font-bold text-primary shadow-lg shadow-gold/20 overflow-hidden">
                <div class="absolute inset-0 w-full h-full bg-white/30 group-hover:translate-x-full transition-transform duration-500 ease-out -translate-x-full skew-x-12"></div>
                <span class="relative flex items-center justify-center gap-2">
                    Mulai Membaca <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </span>
            </a>
            @endif
            <a href="#fitur" class="px-8 py-4 rounded-full border border-slate-700 text-white font-medium hover:bg-slate-800 transition-all hover:border-slate-500">
                Pelajari Fitur
            </a>
        </div>

        <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl text-left">
            <div class="glass-card p-6 rounded-2xl hover:border-gold/30 transition-colors group">
                <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center text-gold mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-layer-group text-xl"></i>
                </div>
                <h3 class="text-white font-serif font-bold text-xl mb-2">Koleksi Lengkap</h3>
                <p class="text-sm text-slate-400">Ribuan judul buku dari berbagai kategori dan penulis ternama tersedia 24/7.</p>
            </div>

            <div class="glass-card p-6 rounded-2xl hover:border-gold/30 transition-colors group">
                <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center text-gold mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <h3 class="text-white font-serif font-bold text-xl mb-2">Akses Aman</h3>
                <p class="text-sm text-slate-400">Platform digital yang aman dan terenkripsi untuk kenyamanan literasi Anda.</p>
            </div>

            <div class="glass-card p-6 rounded-2xl hover:border-gold/30 transition-colors group">
                <div class="w-12 h-12 bg-slate-800 rounded-xl flex items-center justify-center text-gold mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-infinity text-xl"></i>
                </div>
                <h3 class="text-white font-serif font-bold text-xl mb-2">Tanpa Batas</h3>
                <p class="text-sm text-slate-400">Pinjam dan baca buku kapan saja, di mana saja melalui perangkat favorit Anda.</p>
            </div>
        </div>

    </main>

    <footer class="relative z-10 w-full py-6 text-center border-t border-slate-800/50 bg-primary/50 backdrop-blur-sm">
        <p class="text-slate-500 text-xs font-medium">
            &copy; {{ date('Y') }} E-Perpus Digital. All rights reserved. <span class="mx-2">|</span> Designed for Excellence.
        </p>
    </footer>

</body>
</html>