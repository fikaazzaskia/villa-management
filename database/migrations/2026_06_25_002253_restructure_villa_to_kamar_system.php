<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('bookings');
        Schema::dropIfExists('villas');

        Schema::create('villa_profile', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->text('fasilitas_umum')->nullable();
            $table->timestamps();
        });

        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->enum('tipe', ['foto', 'video'])->default('foto');
            $table->string('file');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('kamar', function (Blueprint $table) {
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

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained('kamar')->onDelete('cascade');
            $table->foreignId('tamu_id')->nullable()->constrained('tamus')->onDelete('set null');
            $table->string('nama_tamu');
            $table->string('email_tamu')->nullable();
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->integer('jumlah_tamu')->default(1);
            $table->enum('status', ['pending', 'konfirmasi', 'selesai', 'batal'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('kamar');
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('villa_profile');
    }
};