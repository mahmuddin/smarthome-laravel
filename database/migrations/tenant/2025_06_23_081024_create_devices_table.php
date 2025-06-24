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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type');                    // lamp, fan, sensor, etc
            $table->boolean('status')->default(false); // on/off
            $table->boolean('is_online')->default(false);
            $table->timestamp('last_active_at')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Tambahkan baris ini untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
