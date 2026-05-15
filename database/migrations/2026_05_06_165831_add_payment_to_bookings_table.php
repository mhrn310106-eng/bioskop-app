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
    Schema::table('bookings', function (Blueprint $table) {
        $table->string('metode_bayar')->nullable();
        $table->string('bukti_bayar')->nullable();
        $table->enum('status_bayar', ['belum_bayar','menunggu_verifikasi','lunas'])
              ->default('belum_bayar');
    });
}

public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn(['metode_bayar','bukti_bayar','status_bayar']);
    });
}
};
