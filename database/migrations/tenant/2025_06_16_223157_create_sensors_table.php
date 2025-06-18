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
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id');
            $table->string('name'); // e.g., "Suhu Ruang Tamu"
            $table->string('type'); // e.g., "temperature", "humidity", "motion"
            $table->float('latest_value')->nullable(); // last read value
            $table->timestamp('last_updated_at')->nullable(); // when last_value updated

            $table->timestamps();

            // Foreign Key
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');

            $table->index(['device_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
