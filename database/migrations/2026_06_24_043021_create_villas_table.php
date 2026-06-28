<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_per_malam', 12, 2);
            $table->integer('kapasitas');
            $table->enum('tipe', ['standard', 'deluxe', 'premium'])->default('standard');
            $table->boolean('tersedia')->default(true);
            $table->text('fasilitas')->nullable();
            $table->string('foto')->nullable();
            $table->string('video_url', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villas');
    }
};