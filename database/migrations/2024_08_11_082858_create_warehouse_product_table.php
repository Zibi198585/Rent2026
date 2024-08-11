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
        Schema::create('warehouse_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade'); // Powiązanie z magazynem
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Powiązanie z produktem
            $table->integer('quantity'); // Liczba sztuk
            $table->enum('status', ['available_for_rent', 'new_for_sale', 'used_for_sale', 'rented']); // Status produktu
            $table->timestamps(); // Czas utworzenia i aktualizacji
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_product');
    }
};
