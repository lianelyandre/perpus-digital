<x-app-layout>
    <div class="max-w-3xl mx-auto pt-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
            <a href="{{ route('user.index') }}" class="text-slate-500 hover:text-navy-900 font-bold text-sm flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header --}}
            <div class="bg-navy-900 px-8 py-6 border-b-4 border-amber-500 relative">
                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-white tracking-wide">REGISTRASI USER BARU</h2>
                        <p class="text-slate-400 text-xs mt-1">Lengkapi form di bawah ini.</p>
                    </div>
                    <i class="fas fa-user-plus text-amber-400 text-3xl opacity-50"></i>
                </div>
            </div>

            <form action="{{ route('user.store') }}" method="POST" class="p-8">
                @csrf

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Username</label>
                            <input type="text" name="username" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password</label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email</label>
                            <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Role Akses</label>
                        <select name="role" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all">
                            <option value="peminjam">Peminjam</option>
                            <option value="petugas">Petugas</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-8 py-3 rounded-xl bg-navy-900 text-white font-bold text-sm uppercase tracking-wider shadow-lg hover:bg-navy-800 transition-all transform hover:-translate-y-1">
                        Simpan Data <i class="fas fa-check ml-2 text-amber-400"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>