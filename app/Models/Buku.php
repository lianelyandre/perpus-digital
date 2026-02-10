<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // 1. Kasih tahu nama tabelnya
    protected $table = 'buku';

    // 2. Kasih tahu primary key-nya (PENTING!)
    protected $primaryKey = 'BukuID';

    // 3. Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'Judul',
        'Penulis',
        'Penerbit',
        'TahunTerbit',
        'Stok'
    ];

    public function ulasanbuku()
    {
        return $this->hasMany(UlasanBuku::class, 'BukuID', 'BukuID');
    }
}
