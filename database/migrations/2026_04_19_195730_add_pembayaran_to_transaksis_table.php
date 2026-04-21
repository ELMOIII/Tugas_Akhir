<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPembayaranToTransaksisTable extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('metode_pembayaran')->nullable();
            $table->integer('bayar')->default(0);
            $table->integer('kembalian')->default(0);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['metode_pembayaran', 'bayar', 'kembalian', 'user_id']);
        });
    }
}