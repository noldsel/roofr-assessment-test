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
        Schema::create('parking_spots', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_available')->default(false)->default(1);
            $table->dateTime('start')->nullable(true);
            $table->dateTime('end')->nullable(true);

            $table->bigInteger('parking_spot_type_id')->unsigned()->nullable();
            $table->string('vehicle_type')->nullable(true);

            $table->foreign('parking_spot_type_id')->references('id')->on('parking_spot_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_spots');
    }
};
