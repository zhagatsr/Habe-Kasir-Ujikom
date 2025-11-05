<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
Schema::create('transaksi', function (Blueprint $t) {
    $t->unsignedInteger('id_transaksi', true); // ← PK unsigned
    $t->string('no_transaksi', 30)->unique();
    $t->unsignedInteger('id_user');           // ← FK unsigned (match kasir.id_user)
    $t->dateTime('tanggal');
    $t->decimal('total_harga', 14, 0);
    $t->enum('metode_bayar', ['CASH','QRIS','TRANSFER']);
    $t->timestamps();

    $t->foreign('id_user')->references('id_user')->on('kasir');
});

  }
  public function down(): void {
    Schema::dropIfExists('transaksi');
  }
};
