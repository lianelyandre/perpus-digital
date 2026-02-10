@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid py-5">

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9">

            {{-- Modern Info Alert --}}
            <div class="modern-alert mb-4">
                <i class="fas fa-user-edit"></i>
                <div>
                    Anda sedang mengedit data user :
                    <strong>{{ $user->nama_lengkap }}</strong>
                </div>
            </div>

            {{-- Main Card --}}
            <div class="lux-card">

                {{-- Header --}}
                <div class="lux-header">
                    <h5>
                        <i class="fas fa-user-cog mr-2"></i>
                        Edit Data Pengguna
                    </h5>

                    <a href="{{ route('user.index') }}" class="btn btn-light btn-sm lux-btn-cancel">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>

                {{-- Body --}}
                <div class="lux-body">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Section --}}
                        <div class="section-title">Informasi Akun</div>

                        <div class="row">
                            <div class="col-md-6">

                                <label class="lux-label">Username</label>
                                <div class="lux-input-group">
                                    <span><i class="fas fa-at"></i></span>
                                    <input type="text"
                                        name="username"
                                        class="lux-input"
                                        value="{{ old('username',$user->username) }}"
                                        readonly>
                                </div>
                                <small class="text-muted">Username tidak bisa diubah</small>

                            </div>

                            <div class="col-md-6">

                                <label class="lux-label">Email</label>
                                <div class="lux-input-group">
                                    <span><i class="fas fa-envelope"></i></span>
                                    <input type="email"
                                        name="email"
                                        class="lux-input @error('email') is-invalid @enderror"
                                        value="{{ old('email',$user->email) }}">
                                </div>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">

                                <label class="lux-label">
                                    Password Baru
                                    <span class="text-muted small">(Opsional)</span>
                                </label>

                                <div class="lux-input-group">
                                    <span><i class="fas fa-lock"></i></span>
                                    <input type="password"
                                        name="password"
                                        class="lux-input">
                                </div>

                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti password
                                </small>

                            </div>

                            <div class="col-md-6">

                                <label class="lux-label">Role</label>
                                <div class="lux-input-group">
                                    <span><i class="fas fa-user-tag"></i></span>

                                    <select name="role" class="lux-input">
                                        <option value="admin" {{ old('role',$user->role)=='admin'?'selected':'' }}>Administrator</option>
                                        <option value="petugas" {{ old('role',$user->role)=='petugas'?'selected':'' }}>Petugas</option>
                                        <option value="peminjam" {{ old('role',$user->role)=='peminjam'?'selected':'' }}>Peminjam</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- Section --}}
                        <div class="section-title mt-5">Informasi Pribadi</div>

                        <label class="lux-label">Nama Lengkap</label>
                        <input type="text"
                            name="nama_lengkap"
                            class="lux-input"
                            value="{{ old('nama_lengkap',$user->nama_lengkap) }}">

                        <label class="lux-label mt-3">Alamat</label>
                        <textarea name="alamat"
                            rows="3"
                            class="lux-input">{{ old('alamat',$user->alamat) }}</textarea>

                        {{-- Submit --}}
                        <div class="text-right mt-5">
                            <button class="lux-btn-save">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- ================= STYLE ================= --}}
<style>
    .lux-card {
        background: white;
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
        overflow: hidden;
    }

    .lux-header {
        padding: 22px 28px;
        border-bottom: 1px solid #f1f3f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .lux-header h5 {
        font-weight: 700;
        margin: 0;
    }

    .lux-body {
        padding: 35px;
    }

    .section-title {
        font-size: 13px;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: 700;
        color: #6b7280;
        margin-bottom: 18px;
    }

    .lux-label {
        font-weight: 600;
        font-size: 13px;
        color: #374151;
        margin-bottom: 6px;
    }

    .lux-input {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 12px 16px;
        background: #fafafa;
        transition: all .2s;
    }

    .lux-input:focus {
        outline: none;
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.08);
    }

    .lux-input-group {
        display: flex;
        align-items: center;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        background: #fafafa;
    }

    .lux-input-group span {
        padding: 12px 14px;
        color: #9ca3af;
    }

    .lux-input-group .lux-input {
        border: none;
        background: transparent;
    }

    .lux-btn-save {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border: none;
        color: white;
        padding: 14px 40px;
        border-radius: 14px;
        font-weight: 600;
        box-shadow: 0 6px 20px rgba(79, 70, 229, .25);
        transition: .2s;
    }

    .lux-btn-save:hover {
        transform: translateY(-2px);
    }

    .modern-alert {
        background: linear-gradient(135deg, #eef2ff, #f5f3ff);
        border-radius: 14px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 14px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.04);
    }

    .modern-alert i {
        font-size: 20px;
        color: #6366f1;
    }

    .lux-btn-cancel {
        border-radius: 10px;
        font-weight: 600;
    }
</style>
@endsection