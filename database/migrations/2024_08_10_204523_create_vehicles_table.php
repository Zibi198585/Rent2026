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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique(); // Numer rejestracyjny
            $table->string('brand'); // Marka
            $table->string('model'); // Model
            $table->date('purchase_date'); // Data zakupu
            $table->date('insurance_date'); // Data ubezpieczenia
            $table->date('inspection_date'); // Data przeglądu
            $table->integer('mileage'); // Przebieg
            $table->string('vehicle_type'); // Typ pojazdu
            $table->string('status'); // Stan pojazdu
            $table->string('vin')->unique(); // Numer VIN
            $table->text('notes')->nullable(); // Uwagi (opcjonalnie)
            $table->timestamps(); // Czas utworzenia i aktualizacji
            $table->softDeletes(); // Miękkie usuwanie
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
