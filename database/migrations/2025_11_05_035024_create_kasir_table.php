<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
Schema::create('kasir', function (Blueprint $t) {
    $t->unsignedInteger('id_user', true);   // ← PK unsigned + auto increment
    $t->string('nama', 100);
    $t->string('username', 50)->unique();
    $t->string('password');
    $t->timestamps();
});

  }
  public function down(): void {
    Schema::dropIfExists('kasir');
  }
};
