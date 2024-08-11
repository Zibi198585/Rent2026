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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nazwa produktu
            $table->float('height')->nullable(); // Wysokość
            $table->float('width')->nullable();; // Szerokość
            $table->float('length')->nullable();; // Długość
            $table->float('weight')->nullable();; // Waga
            $table->timestamps(); // Czas utworzenia i aktualizacji
            $table->softDeletes(); // Miękkie usuwanie
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
