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
    Schema::create('bookings', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('film_id')->constrained()->onDelete('cascade');
    $table->foreignId('studio_id')->nullable()->constrained()->nullOnDelete();

    $table->date('tanggal_booking');
    $table->time('jam_booking');

    $table->integer('jumlah_tiket');
    $table->integer('harga_tiket')->default(35000);
    $table->integer('total_harga');

    $table->enum('status', ['pending','confirmed','cancelled'])->default('pending');
    $table->string('kode_booking')->unique();

    $table->string('metode_bayar')->nullable();
    $table->string('bukti_bayar')->nullable();
    $table->enum('status_bayar', ['belum_bayar','menunggu_verifikasi','lunas'])
          ->default('belum_bayar');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
