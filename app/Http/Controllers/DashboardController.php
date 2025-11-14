<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi; // ✅ tambahkan ini
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil waktu hari ini dan awal bulan
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();

        // ✅ Ambil data nyata dari tabel transaksi
        $totalTransaksiHariIni = Transaksi::whereDate('tanggal', $today)->count();
        $totalPenjualanHariIni = Transaksi::whereDate('tanggal', $today)->sum('total_harga');
        $jumlahBarang = Barang::count();
        $penjualanBulanIni = Transaksi::whereBetween('tanggal', [$monthStart, Carbon::now()])->sum('total_harga');

    // 🔥 Ambil data penjualan 7 hari terakhir
$penjualan7Hari = \App\Models\Transaksi::selectRaw('DATE(tanggal) as tgl, SUM(total_harga) as total')
    ->where('tanggal', '>=', Carbon::today()->subDays(6))
    ->groupBy('tgl')
    ->orderBy('tgl', 'asc')
    ->get();

// Biar urutan harinya tetap lengkap meskipun ada hari kosong
$labels = [];
$totals = [];
for ($i = 6; $i >= 0; $i--) {
    $day = Carbon::today()->subDays($i)->format('Y-m-d');
    $labels[] = Carbon::today()->subDays($i)->format('d M');
    $found = $penjualan7Hari->firstWhere('tgl', $day);
    $totals[] = $found ? $found->total : 0;
}


        // Kalau kamu tetap mau tampilkan data barang (misal untuk tabel lain)
        $barang = Barang::all();

        // Kirim semua ke view dashboard
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
