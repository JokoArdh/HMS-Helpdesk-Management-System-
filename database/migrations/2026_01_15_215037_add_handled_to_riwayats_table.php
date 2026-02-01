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
        Schema::table('riwayats', function (Blueprint $table) {
            $table->foreignId('handled_by')->nullable()->after('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayats', function (Blueprint $table) {
            $table->dropColumn('handled_by');
            $table->dropForeign(['handled_by']);
        });
    }
};
