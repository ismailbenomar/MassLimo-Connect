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
        Schema::create('transportation_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('price_estimates_enabled')->default(false);
            $table->decimal('base_fee', 8, 2)->default(0);
            $table->decimal('per_mile_rate', 8, 2)->default(0);
            $table->decimal('per_minute_rate', 8, 2)->default(0);
            $table->decimal('minimum_estimate', 8, 2)->default(0);
            $table->unsignedSmallInteger('maximum_distance_miles')->default(300);
            $table->char('currency', 3)->default('USD');
            $table->string('estimate_disclaimer', 500)->default('This planning estimate is not a quote or confirmed reservation. An independent provider confirms availability, final pricing and reservation terms directly.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportation_settings');
    }
};
