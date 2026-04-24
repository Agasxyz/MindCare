<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        try {
            // FIX KOMENTAR & KOMUNITAS
            // ------------------------
            // 1. Drop FK on Komentar
            try {
                DB::statement("ALTER TABLE komentar DROP FOREIGN KEY komentar_ibfk_1");
            } catch (\Exception $e) {
                // If failed, try array syntax generic name (just in case)
                try {
                    Schema::table('komentar', function (Blueprint $table) {
                        $table->dropForeign(['id_post']);
                    });
                } catch (\Exception $e2) {
                }
            }

            // 2. Modify Columns (Auto Increment)
            if (Schema::hasTable('komentar')) {
                Schema::table('komentar', function (Blueprint $table) {
                    $table->unsignedBigInteger('id_komentar', true)->change();
                });
            }

            if (Schema::hasTable('komunitas')) {
                Schema::table('komunitas', function (Blueprint $table) {
                    $table->unsignedBigInteger('id_post', true)->change();
                });
            }

            // 3. Re-add FK Komentar -> Komunitas
            if (Schema::hasTable('komentar') && Schema::hasTable('komunitas')) {
                try {
                    Schema::table('komentar', function (Blueprint $table) {
                        $table->foreign('id_post', 'komentar_ibfk_1')
                            ->references('id_post')->on('komunitas')
                            ->onDelete('cascade');
                    });
                } catch (\Exception $e) {
                }
            }


            // FIX SELF_TEST & MEDITASI
            // ------------------------
            // 4. Drop FK on SelfTest
            try {
                DB::statement("ALTER TABLE self_test DROP FOREIGN KEY self_test_ibfk_2");
            } catch (\Exception $e) {
                try {
                    Schema::table('self_test', function (Blueprint $table) {
                        $table->dropForeign(['id_meditasi']);
                    });
                } catch (\Exception $e2) {
                }
            }

            // 5. Modify Columns
            if (Schema::hasTable('meditasi')) {
                Schema::table('meditasi', function (Blueprint $table) {
                    $table->unsignedBigInteger('id_meditasi', true)->change();
                });
            }

            if (Schema::hasTable('self_test')) {
                Schema::table('self_test', function (Blueprint $table) {
                    $table->unsignedBigInteger('id_test', true)->change();
                }); // self_test PK fix

                // Re-add FK
                try {
                    Schema::table('self_test', function (Blueprint $table) {
                        $table->foreign('id_meditasi', 'self_test_ibfk_2')
                            ->references('id_meditasi')->on('meditasi')
                            ->onDelete('cascade');
                    });
                } catch (\Exception $e) {
                }
            }


            // FIX GOALS
            // ---------
            if (Schema::hasTable('goals')) {
                Schema::table('goals', function (Blueprint $table) {
                    $table->unsignedBigInteger('id_goals', true)->change();
                });
            }

        } finally {
            Schema::enableForeignKeyConstraints();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert auto_increment is rarely needed but defined for completeness
    }
};
