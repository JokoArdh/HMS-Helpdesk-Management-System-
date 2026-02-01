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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barangs')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('approve_by')->nullable()->constrained('users');
            $table->enum('jenis_transaksi', ['masuk', 'keluar']);
            $table->integer('jumlah');
            $table->date('tgl_transaksi');  
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('tgl_approve')->nullable();
            $table->timestamps();

            //indexes for optimization
            $table->index('tgl_transaksi');
            $table->index('status');
            $table->index(['barang_id', 'tgl_transaksi']);
            $table->index(['status', 'tgl_transaksi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
