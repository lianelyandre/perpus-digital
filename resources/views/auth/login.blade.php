<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | E-Perpus</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                        primary: '#0f172a', // Slate 900
                        gold: '#d4af37', // Metallic Gold
                        goldlight: '#fcd34d',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-primary font-sans text-white antialiased h-screen flex overflow-hidden">

    <div class="hidden lg:flex w-1/2 relative bg-slate-800 justify-center items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1507842217121-9e962835d75d?q=80&w=2070&auto=format&fit=crop"
                alt="Library Background"
                class="w-full h-full object-cover opacity-60">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/60 to-transparent z-10"></div>

        <div class="relative z-20 p-12 text-center">
            <div class="w-16 h-1 bg-gold mx-auto mb-6"></div>
            <h2 class="font-serif text-4xl font-bold text-white mb-4 italic leading-tight">
                "Buku adalah cermin jiwamu."
            </h2>
            <p class="text-slate-300 text-sm tracking-widest uppercase">Virginia Woolf</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 relative">
        <a href="/" class="absolute top-8 left-8 text-slate-400 hover:text-white transition-colors flex items-center gap-2 text-sm group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Kembali
        </a>

        <div class="w-full max-w-md space-y-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-slate-800 text-gold mb-4 border border-slate-700 shadow-lg shadow-gold/10">
                    <i class="fas fa-book-open text-xl"></i>
                </div>
                <h2 class="font-serif text-3xl font-bold text-white">Selamat Datang</h2>
                <p class="mt-2 text-sm text-slate-400">Masuk untuk melanjutkan petualangan literasimu.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="username" class="block text-xs font-medium text-slate-300 uppercase tracking-wider">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i class="fas fa-user"></i>
                        </div>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                            class="block w-full pl-10 pr-3 py-3 border border-slate-700 rounded-lg leading-5 bg-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold sm:text-sm transition-all shadow-sm"
                            placeholder="Masukkan username anda">
                    </div>
                    @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-xs font-medium text-slate-300 uppercase tracking-wider">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full pl-10 pr-3 py-3 border border-slate-700 rounded-lg leading-5 bg-slate-800 text-white placeholder-slate-500 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold sm:text-sm transition-all shadow-sm"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-gold focus:ring-gold border-slate-600 rounded bg-slate-700">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-400">
                            Ingat saya
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-gold hover:text-goldlight transition-colors">
                        Lupa password?
                    </a>
                    @endif
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-primary bg-gradient-to-r from-yellow-600 to-gold hover:from-gold hover:to-yellow-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold transition-all transform hover:scale-[1.02] shadow-gold/20">
                    MASUK SEKARANG
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="text-sm text-slate-400">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-gold hover:text-white transition-colors">
                        Daftar disini
                    </a>
                </p>
            </div>
        </div>

        <div class="absolute bottom-6 text-slate-600 text-xs">
            &copy; {{ date('Y') }} E-Perpus Digital. Protected.
        </div>
    </div>

</body>

</html>