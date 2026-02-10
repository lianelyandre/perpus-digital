<x-app-layout>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">

    <!-- Luxury Theme Overrides -->
    <style>
        .dataTables_wrapper .dataTables_filter input {
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 6px 14px;
            margin-left: 8px;
            transition: all 0.25s ease;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 2px rgba(212,175,55,0.15);
            outline: none;
        }

        .page-item.active .page-link {
            background-color: #0f172a !important;
            border-color: #0f172a !important;
            color: #d4af37 !important;
            font-weight: 600;
        }

        .page-link {
            color: #475569 !important;
            border-radius: 8px !important;
            margin: 0 2px;
        }

        table.dataTable thead th {
            background: #f8fafc;
            border-bottom: 2px solid #d4af37 !important;
            color: #0f172a;
            font-size: 0.75rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 py-6 space-y-6">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Manajemen Pengguna
                </h1>
                <p class="text-sm text-slate-500">
                    Kelola akun administrator, petugas, dan peminjam
                </p>
            </div>

            <a href="{{ route('user.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold uppercase tracking-wider rounded-xl shadow-lg shadow-slate-900/20 transition-all hover:-translate-y-0.5">
                <span class="w-5 h-5 flex items-center justify-center rounded-full bg-white/20">
                    <i class="fas fa-plus text-amber-400 text-[10px]"></i>
                </span>
                Tambah User
            </a>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

            <!-- Card Header -->
            <div class="bg-slate-900 px-6 py-4 border-b-4 border-amber-400 flex items-center gap-3">
                <div class="bg-white/10 p-2 rounded-lg text-amber-400">
                    <i class="fas fa-users"></i>
                </div>
                <h2 class="text-white font-semibold tracking-wide uppercase text-sm">
                    Daftar Akun Pengguna
                </h2>
            </div>

            <!-- Table -->
            <div class="p-6">
                <table id="tabelUser" class="w-full text-sm">
                    <thead>
                        <tr>
                            <th class="py-3 px-4">User</th>
                            <th class="py-3 px-4">Alamat</th>
                            <th class="py-3 px-4 text-center">Role</th>
                            <th class="py-3 px-4 text-center w-32">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $u)
                        <tr class="hover:bg-slate-50 transition-colors duration-150">

                            <!-- User Info -->
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-xs font-bold text-slate-900 uppercase">
                                        {{ substr($u->nama_lengkap, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-800 text-sm">
                                            {{ $u->nama_lengkap }}
                                        </div>
                                        <div class="text-xs text-slate-400 font-mono">
                                            @{{ $u->username }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Address -->
                            <td class="px-4 py-3 text-xs text-slate-600">
                                {{ $u->alamat ?? '-' }}
                            </td>

                            <!-- Role -->
                            <td class="px-4 py-3 text-center">
                                @if($u->role == 'admin')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-semibold bg-slate-900 text-amber-400 border border-slate-800">
                                        <i class="fas fa-crown text-[9px]"></i>
                                        ADMIN
                                    </span>
                                @elseif($u->role == 'petugas')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        <i class="fas fa-id-badge text-[9px]"></i>
                                        PETUGAS
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                        <i class="fas fa-user text-[9px]"></i>
                                        PEMINJAM
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('user.edit', $u->id) }}"
                                       class="w-8 h-8 flex items-center justify-center rounded-lg bg-amber-50 text-amber-600 border border-amber-100 hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                        <i class="fas fa-pen text-[10px]"></i>
                                    </a>

                                    @if(Auth::id() != $u->id)
                                    <form action="{{ route('user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 border border-red-100 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash text-[10px]"></i>
                                        </button>
                                    </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tabelUser').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 5,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Hal _PAGE_ dari _PAGES_",
                    infoEmpty: "Kosong",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: { next: ">", previous: "<" }
                }
            });
        });
    </script>

</x-app-layout>
