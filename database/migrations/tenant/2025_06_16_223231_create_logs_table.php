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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('device_id')->nullable(); // opsional, tergantung log
            $table->unsignedBigInteger('sensor_id')->nullable(); // opsional, tergantung log

            $table->string('event_type'); // e.g., 'device_on', 'sensor_triggered'
            $table->text('description')->nullable(); // penjelasan tambahan
            $table->json('payload')->nullable(); // data tambahan (opsional)
            $table->timestamp('event_time')->nullable(); // kapan peristiwa terjadi

            $table->timestamps();

            // Relasi opsional
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('set null');
            $table->foreign('sensor_id')->references('id')->on('sensors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
