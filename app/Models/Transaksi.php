<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'metode_bayar',
        'total_harga',
    ];
    protected $casts = [
    'tanggal' => 'datetime',
];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}

