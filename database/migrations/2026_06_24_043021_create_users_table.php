<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 50)->primary();
            $table->string('password', 200);
            $table->string('extend', 100);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('role', ['admin', 'staff'])->default('staff');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};