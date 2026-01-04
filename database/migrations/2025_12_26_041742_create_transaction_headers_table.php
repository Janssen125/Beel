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
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->string('nama_customer');
            $table->foreignId('pusat_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            // Menyimpan nomor meja jika ada (bisa aja cuma beli minum), ga dibuat relasi karena bisa saja mejanya mau dihapus
            $table->string('nomor_meja')->nullable();
            $table->bigInteger('total_waktu_detik')->nullable(); // format 'HH jam MM menit SS detik'
            $table->bigInteger('harga_per_jam')->nullable();
            $table->timestamp('waktu_tutup')->nullable();
            $table->bigInteger('total_harga')->default(0);
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_headers');
    }
};
