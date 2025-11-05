<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['no_transaksi', 'id_user', 'tanggal', 'total_harga', 'metode_bayar'];

    protected $casts = [
        'id_user'      => 'integer',
        'tanggal'      => 'datetime',
        'total_harga'  => 'integer',
    ];

    // Relasi: transaksi milik satu kasir
    public function kasir()
    {
        return $this->belongsTo(Kasir::class, 'id_user', 'id_user');
    }

    // Relasi: transaksi punya banyak detail
    public function details()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }
}
