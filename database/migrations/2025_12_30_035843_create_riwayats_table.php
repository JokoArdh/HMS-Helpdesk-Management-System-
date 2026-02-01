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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('keluhan_id')->constrained('keluhans');
            $table->enum('status', ['pending', 'rejected', 'proses', 'done'])->default('pending'); //IT
            $table->enum('action', ['rejected', 'create', 'approved', 'proses', 'update', 'delete'])->default('create'); 
            $table->string('catatan')->nullable();
            $table->timestamps();

            //indexes for faster queries
            $table->index('keluhan_id');
            $table->index('keluhan_id', 'created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
