<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    
    // Primary Key di gambar lu adalah 'id' (kecil)
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'user_id', // Ini buat ID Peminjam (kolom nomor 2 di gambar)
        'BukuID',
        'TanggalPeminjaman',
        'TanggalPengembalian',
        'StatusPeminjaman',
        'jumlah',
        'Denda',
        'Stok'
    ];

    // Relasi ke User (Sesuaikan foreign key)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke Buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID', 'BukuID');
    }
}