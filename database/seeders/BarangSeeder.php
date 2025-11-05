<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama_barang' => 'Stang Lowrider', 'harga' => 85000, 'stok' => 10],
            ['nama_barang' => 'Stang Ninja',     'harga' => 49000, 'stok' => 20],
            // tambah contoh lain kalau perlu
        ];

        foreach ($items as $i) {
            Barang::create($i);
        }
    }
}
