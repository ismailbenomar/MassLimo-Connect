<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone', 32);
            $table->string('email')->nullable();
            $table->string('service_type');
            $table->string('pickup_city');
            $table->string('destination');
            $table->date('preferred_trip_date')->nullable();
            $table->string('preferred_trip_time')->nullable();
            $table->unsignedTinyInteger('passengers')->nullable();
            $table->text('details')->nullable();
            $table->string('status')->default('new')->index();
            $table->string('source_page')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->text('internal_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
