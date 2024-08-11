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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Imię
            $table->string('middle_name')->nullable(); // Drugie imię
            $table->string('last_name'); // Nazwisko
            $table->string('address_line_1'); // Adres linia 1
            $table->string('address_line_2')->nullable(); // Adres linia 2
            $table->string('post_code'); // Kod pocztowy
            $table->string('city'); // Miasto
            $table->string('province'); // Województwo
            $table->string('country'); // Kraj
            $table->string('phone_number'); // Numer telefonu
            $table->string('email')->unique(); // Adres email
            $table->string('pesel')->nullable(); // PESEL
            $table->timestamps(); // Czas utworzenia i aktualizacji
            $table->softDeletes(); // Miekie usówanie danych

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
};
