<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    public $timestamps = false;

    protected $fillable = [
        'nama_barang', 'harga', 'stok', 'foto'
    ];

    protected $dates = ['deleted_at'];
}
