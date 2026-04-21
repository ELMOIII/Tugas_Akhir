<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->integer('harga_beli')->after('nama_barang');
            $table->integer('harga_jual')->after('harga_beli');

            $table->dropColumn('harga'); // hapus harga lama
        });
    }

    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->integer('harga');
            $table->dropColumn(['harga_beli', 'harga_jual']);
        });
    }
};
