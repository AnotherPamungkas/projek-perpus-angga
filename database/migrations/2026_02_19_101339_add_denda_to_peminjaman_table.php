<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->decimal('denda', 10, 2)->default(0);
            $table->enum('status_pembayaran', ['belum_bayar', 'sudah_bayar'])
                  ->default('belum_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn(['denda', 'status_pembayaran']);
        });
    }
};
