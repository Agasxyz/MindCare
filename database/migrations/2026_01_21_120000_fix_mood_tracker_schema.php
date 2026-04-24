<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mood_tracker', function (Blueprint $table) {
            // Kita pastikan id_mood menjadi auto_increment
            // Karena error 1364 id_mood doesn't have a default value
            $table->unsignedBigInteger('id_mood', true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mood_tracker', function (Blueprint $table) {
            // Revert back if needed, though usually we don't want to remove auto_increment
            $table->unsignedBigInteger('id_mood', false)->change();
        });
    }
};
