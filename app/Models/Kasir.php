<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;

    protected $table = 'kasir';          
    protected $primaryKey = 'id_user';   
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'username', 'password'];
    protected $hidden   = ['password'];

    
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_user', 'id_user');
    }
}
