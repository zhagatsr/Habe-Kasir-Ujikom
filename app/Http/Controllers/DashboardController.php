<?php

namespace App\Http\Controllers;

use App\Models\Barang; // pastikan model sudah di-import
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data barang untuk ditampilkan di dashboard
        $barang = Barang::all();

        // Data statistik lain (opsional, sesuaikan punyamu)
        $totalTransaksiHariIni = 0;
        $totalPenjualanHariIni = 0;
        $jumlahBarang = $barang->count();
        $penjualanBulanIni = 0;

        return view('dashboard', compact(
            'barang',
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'jumlahBarang',
            'penjualanBulanIni'
        ));
    }
}
