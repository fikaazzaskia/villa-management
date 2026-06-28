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
        Schema::dropIfExists('kamar');

        Schema::table('villa_profile', function (Blueprint $table) {
            $table->decimal('harga_per_malam', 12, 2)->default(0)->after('no_telp');
            $table->integer('kapasitas')->default(1)->after('harga_per_malam');
            $table->integer('jumlah_kamar_tidur')->default(1)->after('kapasitas');
            $table->boolean('tersedia')->default(true)->after('jumlah_kamar_tidur');
            $table->string('foto_utama')->nullable()->after('tersedia');
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
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
        Schema::table('villa_profile', function (Blueprint $table) {
            $table->dropColumn(['harga_per_malam', 'kapasitas', 'jumlah_kamar_tidur', 'tersedia', 'foto_utama']);
        });
    }
};