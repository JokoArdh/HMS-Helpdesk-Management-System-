<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus constraint lama jika ada
        DB::statement("ALTER TABLE barangs DROP CONSTRAINT IF EXISTS barangs_kondisi_check");

        // Tambahkan constraint baru sesuai kebutuhan
        DB::statement("ALTER TABLE barangs ADD CONSTRAINT barangs_kondisi_check CHECK (kondisi IN ('baru','second','rusak'))");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Hapus constraint baru
         DB::statement("ALTER TABLE barangs DROP CONSTRAINT IF EXISTS barangs_kondisi_check");

         // Kembalikan ke constraint lama (misalnya hanya 'baik','rusak')
         DB::statement("ALTER TABLE barangs ADD CONSTRAINT barangs_kondisi_check CHECK (kondisi IN ('baik','rusak'))");
 
    }
};
