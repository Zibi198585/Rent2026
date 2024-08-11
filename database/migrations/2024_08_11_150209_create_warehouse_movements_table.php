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
        Schema::create('warehouse_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade'); // Powiązanie z magazynem
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Powiązanie z produktem
            $table->foreignId('expense_id')->nullable()->constrained()->onDelete('cascade'); // Powiązanie z kosztem (opcjonalne)
            //$table->foreignId('rental_id')->nullable()->constrained()->onDelete('cascade'); // Powiązanie z umową wynajmu (opcjonalne)
            //$table->foreignId('sale_id')->nullable()->constrained()->onDelete('cascade'); // Powiązanie z umową sprzedaży (opcjonalne)
            $table->integer('quantity'); // Ilość
            $table->enum('type', ['inbound', 'outbound', 'return']); // Typ ruchu (przyjęcie, wydanie, zwrot)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_movements');
    }
};
