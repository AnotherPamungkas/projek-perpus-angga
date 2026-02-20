<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku_favorit', function (Blueprint $table) {
    $table->id();

    $table->foreignId('peminjam_id')
          ->constrained('users', 'id')
          ->onDelete('cascade');

    $table->foreignId('buku_id')
          ->constrained('buku', 'id')
          ->onDelete('cascade');

    $table->timestamps();

    // Supaya tidak bisa favorit buku yang sama dua kali
    $table->unique(['peminjam_id', 'buku_id']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_favorit');
    }
};
