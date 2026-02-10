<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanBuku extends Model
{
    protected $table = 'ulasanbuku'; // Sesuaikan nama tabel lu
    protected $primaryKey = 'UlasanID'; // Sesuaikan Primary Key lu

    // RELASI KE BUKU (Ini yang bikin error tadi bray!)
    public function buku()
    {
        // Parameter: (Model, foreign_key_di_ulasan, local_key_di_buku)
        return $this->belongsTo(Buku::class, 'BukuID', 'BukuID');
    }

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}