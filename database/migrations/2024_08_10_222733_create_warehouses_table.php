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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('office_id')->constrained()->onDelete('cascade'); // Powiązanie z oddziałem
            $table->string('name'); // Nazwa magazynu
            $table->string('location'); // Lokalizacja magazynu
            $table->timestamps(); // Czas utworzenia i aktualizacji
            $table->softDeletes(); // Miękkie usuwanie
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
