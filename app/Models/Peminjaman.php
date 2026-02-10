<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'PeminjamanID';
    protected $fillable = [
        'id', // Tambahin atau ganti jadi 'id'
        'BukuID',
        'TanggalPeminjaman',
        'TanggalPengembalian',
        'StatusPeminjaman'
    ];

    // Relasi ke User (Satu pinjaman punya satu user)
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Relasi ke Buku (Satu pinjaman punya satu buku)
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID');
    }
}
