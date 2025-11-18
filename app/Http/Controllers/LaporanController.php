<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    
    public function index(Request $r)
    {
        $tanggal = $r->input('tanggal'); 
        $query = Transaksi::query();

        
        if ($tanggal) {
            $query->whereDate('tanggal', Carbon::parse($tanggal)->format('Y-m-d'));
        }

     
        $transaksi = $query->orderBy('tanggal', 'desc')->get();

        $totalTransaksi = $transaksi->count();
        $totalPenjualan = $transaksi->sum('total_harga');

        return view('laporan.index', compact(
            'transaksi', 'totalTransaksi', 'totalPenjualan', 'tanggal'
        ));
    }

public function detail($id)
{
    $transaksi = Transaksi::with(['details.barang'])->find($id);

    if (!$transaksi) {
        return response()->json(['success' => false]);
    }

    return response()->json([
        'success' => true,
        'transaksi' => [
            'id_transaksi'  => $transaksi->id_transaksi,
            'no_transaksi'  => $transaksi->no_transaksi,
            'tanggal'       => $transaksi->tanggal,
            'metode_bayar'  => ucfirst($transaksi->metode_bayar),
            'total_harga'   => $transaksi->total_harga,
            'details'       => $transaksi->details->map(function ($d) {
                return [
                    'id_barang'     => $d->id_barang,
                    'jumlah'        => $d->jumlah,
                    'subtotal'      => $d->subtotal,
                    'barang'        => [
                        'nama_barang' => $d->barang->nama_barang ?? '-',
                    ]
                ];
            }),
        ],
    ]);
}

    // ======== CETAK LAPORAN ========
    public function cetak(Request $r)
    {
        $tanggal = $r->input('tanggal');
        $query = Transaksi::query();

        if ($tanggal) {
            $query->whereDate('tanggal', Carbon::parse($tanggal)->format('Y-m-d'));
        }

        $transaksi = $query->orderBy('tanggal', 'asc')->get();
        $totalTransaksi = $transaksi->count();
        $totalPenjualan = $transaksi->sum('total_harga');

        return view('laporan.cetak', compact(
            'transaksi', 'totalTransaksi', 'totalPenjualan', 'tanggal'
        ));
    }
}
