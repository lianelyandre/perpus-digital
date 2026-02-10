<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::create([
            'username' => 'admin',
            'password' => bcrypt('123'),
            'email' => 'admin@gmail.com',
            'nama_lengkap' => 'Administrator Perpus',
            'alamat' => 'Jl. Merdeka No. 1',
            'role' => 'admin'
        ]);
    }
}
