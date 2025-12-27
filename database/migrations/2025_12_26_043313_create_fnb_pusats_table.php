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
        Schema::create('fnb_pusats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fnb_id')->constrained('fnb')->onDelete('cascade');
            $table->foreignId('pusat_id')->constrained('pusats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fnb_pusats');
    }
};
