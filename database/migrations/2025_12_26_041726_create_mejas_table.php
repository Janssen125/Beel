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
        Schema::create('mejas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pusat_id')->constrained()->onDelete('cascade');
            $table->foreignId('jenis_meja_id')->constrained()->onDelete('cascade');
            $table->string('nomor_meja');
            $table->bigInteger('harga_per_jam');
            $table->enum('status', ['kosong', 'diambil', 'rusak', 'tidak_tersedia'])->default('kosong');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};
