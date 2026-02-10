<x-app-layout>
    <div class="max-w-3xl mx-auto pt-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
            <a href="{{ route('user.index') }}" class="text-slate-500 hover:text-navy-900 font-bold text-sm flex items-center gap-2">
                <i class="fas fa-times"></i> Batal Edit
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header Gold Gradient (Pembeda mode Edit) --}}
            <div class="bg-gradient-to-r from-amber-500 to-amber-400 px-8 py-6 relative">
                <div class="relative z-10 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-white tracking-wide">EDIT DATA PENGGUNA</h2>
                        <p class="text-white/80 text-xs mt-1">Mengubah data: <strong>{{ $user->nama_lengkap }}</strong></p>
                    </div>
                    <i class="fas fa-user-edit text-white/30 text-3xl"></i>
                </div>
            </div>

            <form action="{{ route('user.update', $user->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Username</label>
                            <input type="text" name="username" value="{{ $user->username }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Password <span class="text-amber-500 normal-case">(Isi jika ingin ubah)</span></label>
                            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" placeholder="Biarkan kosong jika tetap">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ $user->nama_lengkap }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all" required>{{ $user->alamat }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Role Akses</label>
                        <select name="role" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-bold focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-all">
                            <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                            <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-8 py-3 rounded-xl bg-amber-500 text-white font-bold text-sm uppercase tracking-wider shadow-lg hover:bg-amber-600 transition-all transform hover:-translate-y-1">
                        Update Perubahan <i class="fas fa-save ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>