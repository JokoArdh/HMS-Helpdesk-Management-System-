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
        // DB::statement("ALTER TABLE barangs MODIFY COLUMN kondisi ENUM('baru','second','rusak')");
        // Buat tipe ENUM baru
        DB::statement("CREATE TYPE kondisi_enum AS ENUM ('baru','second','rusak')");

        // Ubah kolom kondisi menjadi tipe ENUM
        DB::statement("ALTER TABLE barangs ALTER COLUMN kondisi TYPE kondisi_enum USING kondisi::text::kondisi_enum");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::statement("ALTER TABLE barangs MODIFY COLUMN kondisi ENUM('baik','rusak')");

        // Rollback ke tipe string biasa
        DB::statement("ALTER TABLE barangs ALTER COLUMN kondisi TYPE varchar(255)");

        // Hapus tipe ENUM
        DB::statement("DROP TYPE IF EXISTS kondisi_enum");

    }
};
