<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksi', function (Blueprint $t) {
            $t->unsignedInteger('id_transaksi', true); // PK
            $t->string('no_transaksi', 30)->unique();
            $t->dateTime('tanggal');
            $t->decimal('total_harga', 14, 0);
            $t->enum('metode_bayar', ['CASH', 'QRIS', 'TRANSFER']);
            $t->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('transaksi');
    }
};
