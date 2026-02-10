@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="lux-header mb-4 p-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="mb-1 font-weight-bold">Manajemen Pengguna</h2>
                <p class="mb-0 opacity-75">Kelola administrator, petugas, dan peminjam.</p>
            </div>

            <a href="{{ route('user.create') }}" class="btn btn-luxury">
                <i class="fas fa-user-plus mr-2"></i> Tambah User
            </a>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-lux-success alert-dismissible fade show shadow-sm border-0 mb-4">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    {{-- CARD TABLE --}}
    <div class="card lux-card border-0">

        <div class="card-header bg-transparent border-0 py-3 px-4">
            <h5 class="mb-0 font-weight-bold">
                <i class="fas fa-users mr-2 text-primary"></i>
                Data Pengguna
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">

                <table class="table lux-table mb-0">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>User</th>
                            <th>Alamat</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $key => $user)
                        <tr>
                            <td class="text-center text-muted font-weight-bold">
                                {{ $key + 1 }}
                            </td>

                            {{-- USER INFO --}}
                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="avatar-lux mr-3">
                                        {{ strtoupper(substr($user->nama_lengkap,0,1)) }}
                                    </div>

                                    <div>
                                        <div class="font-weight-bold text-dark">
                                            {{ $user->nama_lengkap }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $user->username }} • {{ $user->email }}
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td class="text-muted small">
                                {{ Str::limit($user->alamat,60) }}
                            </td>

                            {{-- ROLE --}}
                            <td class="text-center">
                                @php
                                $roleClass = match($user->role) {
                                'admin' => 'role-admin',
                                'petugas' => 'role-petugas',
                                default => 'role-user'
                                };
                                @endphp

                                <span class="role-badge {{ $roleClass }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="btn-group">

                                    <a href="{{ route('user.edit',$user->id) }}"
                                        class="btn btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('user.destroy',$user->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-action btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-users fa-3x mb-3 opacity-50"></i>
                                <div>Belum ada data pengguna</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

        <div class="card-footer bg-transparent border-0 text-muted px-4 py-3">
            Total Data : {{ $users->count() }}
        </div>

    </div>
</div>


{{-- ================= LUXURY STYLE ================= --}}
<style>
    body {
        background: linear-gradient(135deg, #f8fafc, #eef2f7);
    }

    /* HEADER */
    .lux-header {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: white;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
    }

    /* CARD */
    .lux-card {
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, .08);
        background: white;
    }

    /* BUTTON LUX */
    .btn-luxury {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        border: none;
        padding: 10px 22px;
        border-radius: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .btn-luxury:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(37, 99, 235, .35);
        color: white;
    }

    /* TABLE */
    .lux-table thead th {
        border: none;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #94a3b8;
        background: #f8fafc;
    }

    .lux-table tbody tr {
        transition: .2s;
    }

    .lux-table tbody tr:hover {
        background: #f1f5f9;
    }

    /* AVATAR */
    .avatar-lux {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(59, 130, 246, .4);
    }

    /* ROLE BADGE */
    .role-badge {
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .role-admin {
        background: #fee2e2;
        color: #dc2626;
    }

    .role-petugas {
        background: #dbeafe;
        color: #2563eb;
    }

    .role-user {
        background: #e2e8f0;
        color: #475569;
    }

    /* ACTION BUTTON */
    .btn-action {
        border-radius: 10px;
        padding: 6px 10px;
        border: none;
        margin: 0 3px;
    }

    .btn-edit {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    /* ALERT */
    .alert-lux-success {
        background: #ecfdf5;
        color: #047857;
        border-radius: 14px;
    }
</style>

@endsection