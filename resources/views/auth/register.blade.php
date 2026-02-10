<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun | E-Perpus</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0f172a', // Slate 900
                        gold: '#d4af37', // Metallic Gold
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-primary min-h-screen flex items-center justify-center p-4 font-sans text-white bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]">

    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-blue-600/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-gold/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="w-full max-w-2xl bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-3xl shadow-2xl overflow-hidden relative">

        <div class="p-8 text-center border-b border-slate-800">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-slate-800 text-gold mb-4 shadow-lg shadow-gold/10">
                <i class="fas fa-user-plus text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-white">Buat Akun Baru</h2>
            <p class="text-slate-400 text-sm mt-1">Isi data diri Anda dengan lengkap dan benar.</p>
        </div>

        <div class="p-8 pt-6">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider ml-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autofocus
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-all text-sm"
                            placeholder="Cth: Ahmad Fulan">
                        @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider ml-1">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-all text-sm"
                            placeholder="username_anda">
                        @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider ml-1">Email Aktif</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-all text-sm"
                        placeholder="contoh@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider ml-1">Alamat Domisili</label>
                    <textarea name="alamat" required rows="2"
                        class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-all text-sm resize-none"
                        placeholder="Masukkan alamat lengkap...">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider ml-1">Password</label>
                        <input type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-all text-sm"
                            placeholder="••••••••">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 bg-slate-800 border border-slate-700 rounded-xl text-white placeholder-slate-600 focus:outline-none focus:border-gold focus:ring-1 focus:ring-gold transition-all text-sm"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-yellow-600 to-gold hover:from-gold hover:to-yellow-500 text-primary font-bold rounded-xl shadow-lg shadow-gold/20 transform hover:-translate-y-0.5 transition-all duration-200">
                        DAFTAR SEKARANG
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-slate-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-bold text-gold hover:text-white transition-colors">
                            Masuk disini
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>

</html>