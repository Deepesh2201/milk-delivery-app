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
        Schema::create('start_onloading', function (Blueprint $table) {
            $table->id();
            $table->integer('onloading_id');
            $table->integer('offloading_id')->default('0');
            $table->string('driver_name');
            $table->string('vehicle_no');
            $table->string('start_km');
            $table->string('end_km');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('start_onloading');
    }
};
