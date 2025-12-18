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
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Layanan (misal: Haircut)
        $table->integer('price'); // Harga (misal: 35000)
        $table->integer('duration')->nullable(); // Durasi (menit)
        $table->text('description')->nullable(); // Deskripsi
        $table->string('image_path')->nullable(); // Foto Layanan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};