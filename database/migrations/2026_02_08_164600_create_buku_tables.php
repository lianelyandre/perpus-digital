<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategoribuku', function (Blueprint $table) {
            $table->id('KategoriID'); // Primary Key sesuai ERD lu
            $table->string('NamaKategori');
            $table->timestamps();
        });

        Schema::create('buku', function (Blueprint $table) {
            $table->id('BukuID'); // Primary Key sesuai ERD lu
            $table->string('Judul');
            $table->string('Penulis');
            $table->string('Penerbit');
            $table->integer('TahunTerbit');
            $table->integer('Stok')->default(0);
            $table->timestamps();
        });
    }
};
