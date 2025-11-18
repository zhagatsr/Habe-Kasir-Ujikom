<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi; 
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

      
        $totalTransaksiHariIni = Transaksi::whereDate('tanggal', $today)->count();
        $totalPenjualanHariIni = Transaksi::whereDate('tanggal', $today)->sum('total_harga');
        $jumlahBarang = Barang::count();
        $penjualanBulanIni = Transaksi::whereBetween('tanggal', [$monthStart, Carbon::now()])->sum('total_harga');

   
$penjualan7Hari = \App\Models\Transaksi::selectRaw('DATE(tanggal) as tgl, SUM(total_harga) as total')
    ->where('tanggal', '>=', Carbon::today()->subDays(6))
    ->groupBy('tgl')
    ->orderBy('tgl', 'asc')
    ->get();


$labels = [];
$totals = [];
for ($i = 6; $i >= 0; $i--) {
    $day = Carbon::today()->subDays($i)->format('Y-m-d');
    $labels[] = Carbon::today()->subDays($i)->format('d M');
    $found = $penjualan7Hari->firstWhere('tgl', $day);
    $totals[] = $found ? $found->total : 0;
}


     
        $barang = Barang::all();


        return view('dashboard', compact(
            'barang',
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'jumlahBarang',
            'penjualanBulanIni',
            'labels',
            'totals'
        ));
    }
}
