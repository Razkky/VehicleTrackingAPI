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
        Schema::create('vehicle_trackers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('manufacturer');
            $table->string('model');
            $table->string('year');
            $table->string('tracking_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_trackers');
    }
};
