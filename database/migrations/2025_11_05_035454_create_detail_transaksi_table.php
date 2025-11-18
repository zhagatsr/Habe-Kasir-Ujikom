<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_transaksi', function (Blueprint $t) {
            $t->bigIncrements('id_detailTransaksi');
            $t->unsignedInteger('id_transaksi');
            $t->unsignedBigInteger('id_barang');
            $t->integer('jumlah');
            $t->decimal('subtotal', 14, 0);
            $t->timestamps();

            $t->foreign('id_transaksi')
              ->references('id_transaksi')
              ->on('transaksi')
              ->cascadeOnDelete();

            $t->foreign('id_barang')
              ->references('id_barang')
              ->on('barang')->cascadeOnDelete();
        });
    }
    public function down(): void {
        Schema::dropIfExists('detail_transaksi');
    }
};
