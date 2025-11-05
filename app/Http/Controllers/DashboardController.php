<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today      = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        $jumlahBarang          = Barang::count();
        $totalTransaksiHariIni = Transaksi::whereDate('tanggal', $today)->count();
        $totalPenjualanHariIni = Transaksi::whereDate('tanggal', $today)->sum('total_harga');
        $penjualanBulanIni     = Transaksi::where('tanggal','>=',$monthStart)->sum('total_harga');

        $aktivitas = Transaksi::orderByDesc('tanggal')->take(10)->get();

        return view('dashboard', compact(
            'jumlahBarang',
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'penjualanBulanIni',
            'aktivitas'
        ));
    }
}
