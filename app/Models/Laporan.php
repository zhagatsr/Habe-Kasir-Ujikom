<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    public $incrementing = true;
    protected $fillable = [
        'total_transaksi',
        'total_penjualan',
        'periode_awal',
        'periode_akhir'
    ];
}
