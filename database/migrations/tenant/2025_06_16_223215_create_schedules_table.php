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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('device_id');
            $table->string('action'); // 'on' or 'off'
            $table->time('scheduled_time'); // Waktu eksekusi dalam satu hari
            $table->json('days')->nullable(); // ['mon', 'tue', 'wed'], null = setiap hari
            $table->boolean('enabled')->default(true);
            $table->timestamp('last_executed_at')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
