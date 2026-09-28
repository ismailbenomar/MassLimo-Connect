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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('request_type')->default('callback')->after('id')->index();
            $table->decimal('estimated_distance_miles', 8, 1)->nullable()->after('destination');
            $table->unsignedSmallInteger('estimated_duration_minutes')->nullable()->after('estimated_distance_miles');
            $table->decimal('estimated_price', 10, 2)->nullable()->after('estimated_duration_minutes');
            $table->char('pricing_currency', 3)->nullable()->after('estimated_price');
            $table->json('route_data')->nullable()->after('pricing_currency');
            $table->json('pricing_snapshot')->nullable()->after('route_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropIndex(['request_type']);
            $table->dropColumn([
                'request_type',
                'estimated_distance_miles',
                'estimated_duration_minutes',
                'estimated_price',
                'pricing_currency',
                'route_data',
                'pricing_snapshot',
            ]);
        });
    }
};
