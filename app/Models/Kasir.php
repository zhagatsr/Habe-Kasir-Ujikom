<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasir';          // singular
    protected $primaryKey = 'id_user';   // PK non-standar
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'username', 'password'];
    protected $hidden   = ['password'];

    // Relasi: kasir memiliki banyak transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}
