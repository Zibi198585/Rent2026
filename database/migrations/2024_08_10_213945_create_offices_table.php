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
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nazwa oddziału
            $table->string('address_line_1'); // Adres linia 1
            $table->string('address_line_2')->nullable(); // Adres linia 2
            $table->string('post_code'); // Kod pocztowy
            $table->string('city'); // Miasto
            $table->string('province'); // Województwo
            $table->string('country'); // Kraj
            $table->string('phone_number'); // Numer telefonu
            $table->string('email')->unique(); // Adres e-mail
            $table->date('established_date'); // Data założenia
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
        Schema::dropIfExists('offices');
    }
};
