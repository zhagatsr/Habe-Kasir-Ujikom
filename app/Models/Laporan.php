<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['total_transaksi', 'total_penjualan', 'periode_awal', 'periode_akhir'];

    protected $casts = [
        'total_transaksi' => 'integer',
        'total_penjualan' => 'integer',
        'periode_awal'    => 'date',
        'periode_akhir'   => 'date',
    ];
}
