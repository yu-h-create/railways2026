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
        Schema::create('timetable_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('train_id')
               ->constrained()
               ->cascadeOnDelete();

            $table->foreignId('station_id')
               ->constrained()
               ->cascadeOnDelete();
               
            $table->time('arrival_time')->nullable();

            $table->time('departure_time')->nullable();

            $table->unsignedInteger('stop_order');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetable_stops');
    }
};
