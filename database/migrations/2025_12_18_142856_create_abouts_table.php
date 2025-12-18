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
    Schema::create('abouts', function (Blueprint $table) {
        $table->id();
        $table->text('history')->nullable(); // Sejarah
        $table->text('mission')->nullable(); // Misi
        $table->string('history_image')->nullable(); // Foto Sejarah
        $table->string('mission_image')->nullable(); // Foto Misi
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};