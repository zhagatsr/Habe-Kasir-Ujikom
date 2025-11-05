<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detailTransaksi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['id_transaksi', 'id_barang', 'jumlah', 'subtotal'];

    protected $casts = [
        'id_transaksi' => 'integer',
        'id_barang'    => 'integer',
        'jumlah'       => 'integer',
        'subtotal'     => 'integer',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }
}
