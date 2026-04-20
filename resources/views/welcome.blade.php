<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Perpus') }}</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tailwind Configuration --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    colors: {
                        primary: '#0f172a', // Navy Gelap (Slate 900)
                        secondary: '#1e293b', // Slate 800
                        gold: '#d4af37', // Luxury Gold
                        goldlight: '#fcd34d',
                    }
                }
            }
        }
    </script>

    <style>
        /* PENTING: Agar scroll ke #fitur berjalan halus */
        html {
            scroll-behavior: smooth;
        }

        /* Animasi Background Blob */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-primary text-slate-300 font-sans antialiased selection:bg-gold selection:text-primary overflow-x-hidden min-h-screen flex flex-col relative">

    {{-- BACKGROUND EFFECT (Fixed) --}}
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-900/30 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-gold/10 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-purple-900/20 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/noise.png')] opacity-[0.03]"></div>
    </div>

    {{-- NAVBAR --}}
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

                    
                @endauth
            @endif
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <main class="relative z-10 flex-1 flex flex-col justify-center items-center px-6 lg:px-8 pt-12 pb-24 text-center">

        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card mb-8 animate-fade-in-down border border-white/10">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-xs font-semibold text-gold uppercase tracking-[0.2em]">Perpustakaan Digital Modern</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-serif font-bold text-white mb-6 leading-tight max-w-4xl">
            Jendela Dunia dalam <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold via-yellow-200 to-gold italic">Genggaman Anda</span>
        </h1>

        <p class="text-lg text-slate-400 mb-10 max-w-2xl leading-relaxed">
            Akses ribuan koleksi buku digital berkualitas tinggi, jurnal akademik, dan literatur modern dengan antarmuka yang elegan dan profesional.
        </p>

        {{-- BUTTONS ACTION --}}
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto mb-20">
            @if (Route::has('register'))
                <a href="{{ route('login') }}" class="group relative px-8 py-4 bg-gradient-to-r from-gold to-yellow-600 rounded-full font-bold text-primary shadow-lg shadow-gold/20 overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-white/30 group-hover:translate-x-full transition-transform duration-500 ease-out -translate-x-full skew-x-12"></div>
                    <span class="relative flex items-center justify-center gap-2">
                        Mulai Membaca <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </a>
            @endif
            
            {{-- Tombol Anchor Link --}}
            <a href="#fitur" class="px-8 py-4 rounded-full border border-slate-600 text-white hover:bg-slate-800 hover:border-slate-500 transition-all font-medium">
                Pelajari Fitur
            </a>
        </div>

    </main>

    {{-- SECTION FITUR (Background Putih) --}}
    <section id="fitur" class="relative py-24 bg-white text-slate-800">
        
        {{-- Dekorasi Background --}}
        <div class="absolute top-0 left-0 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl translate-x-1/3 translate-y-1/3 pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">
            
            {{-- Judul Section --}}
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-serif font-bold text-primary mb-4">Kenapa Harus <span class="text-gold">E-Perpus?</span></h2>
                <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
                <p class="text-slate-500 mt-4 max-w-2xl mx-auto">Kami menghadirkan pengalaman literasi digital terbaik untuk mendukung produktivitas dan wawasan Anda.</p>
            </div>

            {{-- Grid Kartu Fitur --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- Kartu 1 --}}
                <div class="group bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-300 shadow-sm border border-slate-100">
                        <i class="fas fa-book-open text-2xl text-primary group-hover:text-gold transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3 group-hover:text-gold transition-colors">Koleksi Terlengkap</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Ribuan buku dari berbagai kategori tersedia untuk menemani harimu. Mulai dari Novel, Sains, hingga Sejarah.
                    </p>
                </div>

                {{-- Kartu 2 --}}
                <div class="group bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gold transition-colors duration-300 shadow-sm border border-slate-100">
                        <i class="fas fa-bolt text-2xl text-gold group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3 group-hover:text-gold transition-colors">Akses Cepat</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Pinjam buku favoritmu hanya dalam sekali klik. Tanpa antri, tanpa ribet, langsung bisa baca di dashboard.
                    </p>
                </div>

                {{-- Kartu 3 --}}
                <div class="group bg-slate-50 p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-500 transition-colors duration-300 shadow-sm border border-slate-100">
                        <i class="fas fa-mobile-alt text-2xl text-emerald-500 group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3 group-hover:text-emerald-600 transition-colors">Fleksibel</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Kompatibel di semua perangkat. Baca lewat HP, Tablet, atau Laptop dengan tampilan yang nyaman di mata.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="relative z-10 w-full py-8 text-center bg-primary text-slate-400 border-t border-slate-800">
        <div class="container mx-auto px-6">
            <p class="text-xs font-medium tracking-wide">
                &copy; {{ date('Y') }} E-Perpus Digital. All rights reserved. 
            </p>
        </div>
    </footer>

</body>
</html>