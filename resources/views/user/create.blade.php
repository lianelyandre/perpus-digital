@extends('layouts.app')

@section('title', 'Tambah User Baru')

@section('content')
<div class="container-fluid py-5">

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9">

            {{-- Header Alert --}}
            <div class="modern-alert mb-4">
                <i class="fas fa-user-plus"></i>
                <div>
                    Tambahkan pengguna baru ke dalam sistem
                </div>
            </div>

            {{-- Card --}}
            <div class="lux-card">

                {{-- Header --}}
                <div class="lux-header">
                    <h5>
                        <i class="fas fa-user-plus mr-2"></i>
                        Tambah Pengguna Baru
                    </h5>

                    <a href="{{ route('user.index') }}" class="btn btn-light btn-sm lux-btn-cancel">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>

                {{-- Body --}}
                <div class="lux-body">

                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        {{-- SECTION --}}
                        <div class="section-title">Informasi Akun</div>

                        <div class="row">
                            <div class="col-md-6">

                                <label class="lux-label">Username</label>
                                <div class="lux-input-group">
                                    <span><i class="fas fa-at"></i></span>
                                    <input type="text"
                                        name="username"
                                        class="lux-input @error('username') is-invalid @enderror"
                                        placeholder="Contoh: johndoe123"
                                        value="{{ old('username') }}">
                                </div>
                                @error('username')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label class="lux-label">Email</label>
                                <div class="lux-input-group">
                                    <span><i class="fas fa-envelope"></i></span>
                                    <input type="email"
                                        name="email"
                                        class="lux-input @error('email') is-invalid @enderror"
                                        placeholder="nama@email.com"
                                        value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">

                                <label class="lux-label">Password</label>
                                <div class="lux-input-group">
                                    <span><i class="fas fa-lock"></i></span>
                                    <input type="password"
                                        name="password"
                                        class="lux-input @error('password') is-invalid @enderror"
                                        placeholder="Minimal 8 karakter">
                                </div>

                                <small class="text-muted">
                                    Gunakan kombinasi huruf dan angka
                                </small>

                                @error('password')
                                <small class="text-danger d-block">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label class="lux-label">Role</label>
                                <div class="lux-input-group">
                                    <span><i class="fas fa-user-tag"></i></span>

                                    <select name="role" class="lux-input">
                                        <option value="">Pilih Role</option>
                                        <option value="admin">Administrator</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="peminjam">Peminjam</option>
                                    </select>
                                </div>

                                @error('role')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>
                        </div>

                        {{-- SECTION --}}
                        <div class="section-title mt-5">Informasi Pribadi</div>

                        <label class="lux-label">Nama Lengkap</label>
                        <input type="text"
                            name="nama_lengkap"
                            class="lux-input @error('nama_lengkap') is-invalid @enderror"
                            placeholder="Nama lengkap sesuai identitas"
                            value="{{ old('nama_lengkap') }}">

                        @error('nama_lengkap')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror


                        <label class="lux-label mt-3">Alamat</label>
                        <textarea name="alamat"
                            rows="3"
                            class="lux-input @error('alamat') is-invalid @enderror"
                            placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>

                        @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        {{-- BUTTON --}}
                        <div class="text-right mt-5">

                            <button type="reset" class="lux-btn-reset">
                                Reset
                            </button>

                            <button class="lux-btn-save">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Data
                            </button>

                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


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

    .lux-btn-reset {
        background: #f3f4f6;
        border: none;
        padding: 14px 26px;
        border-radius: 14px;
        font-weight: 600;
        margin-right: 10px;
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
</style>

@endsection