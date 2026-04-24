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
        Schema::table('self_test', function (Blueprint $table) {
            $table->timestamp('created_at')->useCurrent();
            $table->string('status')->nullable()->after('skor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('self_test', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'status']);
        });
    }
};
