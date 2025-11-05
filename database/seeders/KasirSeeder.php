<?php

namespace Database\Seeders;

use App\Models\Kasir;
use Illuminate\Database\Seeder;

class KasirSeeder extends Seeder
{
    public function run(): void
    {
        // akun login utama
        Kasir::updateOrCreate(
            ['username' => 'kasir'], // unique
            [
                'nama'     => 'Kasir',
                'password' => bcrypt('12345'), // ganti nanti di menu ganti password
            ]
        );
    }
}
