<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
Schema::create('laporan', function (Blueprint $t) {
    $t->unsignedInteger('id_laporan', true); 
    $t->integer('total_transaksi');
    $t->decimal('total_penjualan', 16, 0);
    $t->date('periode_awal');
    $t->date('periode_akhir');
    $t->timestamps();
});

  }
  public function down(): void {
    Schema::dropIfExists('laporan');
  }
};
