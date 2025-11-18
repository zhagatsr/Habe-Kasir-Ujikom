<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    
     
     
    public function run(): void
    {
        $data = [
            ['id_barang' => '001', 'nama_barang' => 'Stang Motor Ninja', 'harga' => 120000, 'stok' => 10],
            ['id_barang' => '002', 'nama_barang' => 'Velg Racing Vario', 'harga' => 650000, 'stok' => 5],
            ['id_barang' => '003', 'nama_barang' => 'Ban Tubeless FDR', 'harga' => 200000, 'stok' => 8],
            ['id_barang' => '004', 'nama_barang' => 'Oli Federal Matic 1L', 'harga' => 45000, 'stok' => 15],
            ['id_barang' => '005', 'nama_barang' => 'Filter Udara Beat', 'harga' => 25000, 'stok' => 20],
            ['id_barang' => '006', 'nama_barang' => 'Kampas Rem Depan Supra', 'harga' => 18000, 'stok' => 25],
            ['id_barang' => '007', 'nama_barang' => 'Aki Kering Yuasa 12V', 'harga' => 175000, 'stok' => 7],
            ['id_barang' => '008', 'nama_barang' => 'Lampu LED Osram Putih', 'harga' => 35000, 'stok' => 12],
            ['id_barang' => '009', 'nama_barang' => 'Busi NGK Iridium', 'harga' => 90000, 'stok' => 10],
            ['id_barang' => '010', 'nama_barang' => 'Gir Belakang SSS', 'harga' => 80000, 'stok' => 9],
            ['id_barang' => '011', 'nama_barang' => 'Rantai DID 415', 'harga' => 95000, 'stok' => 10],
            ['id_barang' => '012', 'nama_barang' => 'Jok Kulit Custom', 'harga' => 250000, 'stok' => 4],
            ['id_barang' => '013', 'nama_barang' => 'Handle Rem CNC', 'harga' => 50000, 'stok' => 14],
            ['id_barang' => '014', 'nama_barang' => 'Spion Bar End', 'harga' => 75000, 'stok' => 8],
            ['id_barang' => '015', 'nama_barang' => 'Helm Bogo Classic', 'harga' => 280000, 'stok' => 6],
            ['id_barang' => '016', 'nama_barang' => 'Sarung Tangan Alpinestar', 'harga' => 120000, 'stok' => 11],
            ['id_barang' => '017', 'nama_barang' => 'Cover Body Vario 125', 'harga' => 600000, 'stok' => 3],
            ['id_barang' => '018', 'nama_barang' => 'Shockbreaker YSS', 'harga' => 950000, 'stok' => 5],
            ['id_barang' => '019', 'nama_barang' => 'Footstep Racing', 'harga' => 85000, 'stok' => 9],
            ['id_barang' => '020', 'nama_barang' => 'Box Motor GIVI E30', 'harga' => 550000, 'stok' => 2],
            ['id_barang' => '021', 'nama_barang' => 'Knalpot Racing R9', 'harga' => 1250000, 'stok' => 4],
            ['id_barang' => '022', 'nama_barang' => 'Disc Brake TDR', 'harga' => 400000, 'stok' => 6],
            ['id_barang' => '023', 'nama_barang' => 'Set Kunci L Motor', 'harga' => 60000, 'stok' => 20],
            ['id_barang' => '024', 'nama_barang' => 'Jas Hujan Axio', 'harga' => 90000, 'stok' => 10],
            ['id_barang' => '025', 'nama_barang' => 'Speedometer Digital', 'harga' => 175000, 'stok' => 5],
            ['id_barang' => '026', 'nama_barang' => 'Standar Tengah Mio', 'harga' => 45000, 'stok' => 7],
            ['id_barang' => '027', 'nama_barang' => 'Kabel Kopling Supra', 'harga' => 22000, 'stok' => 18],
            ['id_barang' => '028', 'nama_barang' => 'Tutup Tangki CNC', 'harga' => 30000, 'stok' => 16],
            ['id_barang' => '029', 'nama_barang' => 'Lampu Sein LED Kuning', 'harga' => 18000, 'stok' => 22],
            ['id_barang' => '030', 'nama_barang' => 'Kabel Gas Universal', 'harga' => 25000, 'stok' => 14],
        ];

        foreach ($data as $b) {
            Barang::create($b);
        }
    }
}
