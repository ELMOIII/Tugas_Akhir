<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangs', function (Blueprint $table) {

            if (!Schema::hasColumn('barangs', 'harga_beli')) {
                $table->integer('harga_beli');
            }

            if (!Schema::hasColumn('barangs', 'harga_jual')) {
                $table->integer('harga_jual');
            }

        });
    }

    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {

            if (Schema::hasColumn('barangs', 'harga_beli')) {
                $table->dropColumn('harga_beli');
            }

            if (Schema::hasColumn('barangs', 'harga_jual')) {
                $table->dropColumn('harga_jual');
            }

        });
    }
};