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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city_en');
            $table->string('city_lt');
            $table->string('country_en');
            $table->string('country_lt');
            $table->string('address');
            $table->enum('type', ['hotel', 'apartments', 'glamping']);
            $table->decimal('price', 8, 2);
            $table->text('description_en')->nullable();
            $table->text('description_lt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
