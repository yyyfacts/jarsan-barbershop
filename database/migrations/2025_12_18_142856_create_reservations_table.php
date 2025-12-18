<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone');
        $table->date('date');
        $table->string('time');
        $table->string('service_name'); // Simpan nama layanannya langsung
        $table->text('notes')->nullable();
        $table->enum('status', ['pending', 'done'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};