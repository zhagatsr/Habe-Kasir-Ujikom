<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
Schema::create('barang', function (Blueprint $t) {
    $t->unsignedInteger('id_barang', true); // ← PK unsigned
    $t->string('nama_barang', 120);
    $t->decimal('harga', 12, 0);
    $t->integer('stok')->default(0);
    $table->string('foto')->nullable();

    $t->timestamps();
});

  }
  public function down(): void {
    Schema::dropIfExists('barang');
  }
};
