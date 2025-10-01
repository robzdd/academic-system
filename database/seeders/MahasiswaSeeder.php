<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'mahasiswa@gmail.com'], // kondisi unik
            [
                'name' => 'Mahasiswa Test',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
