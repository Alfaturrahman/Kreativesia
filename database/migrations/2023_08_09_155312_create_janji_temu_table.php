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
        Schema::create('janji_temu', function (Blueprint $table) {
            $table->bigIncrements('id_janji_temu');
            $table->bigInteger('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('no_str');
            $table->foreign('no_str')->references('no_str')->on('psikolog')->onDelete('cascade')->onUpdate('cascade');
            $table->string('keluhan_umum');
            $table->text('detail_masalah');
            $table->date('tanggal');
            $table->time('jam');
            $table->enum('jenis_konsultasi', ['online','offline'])->default('online');
            $table->enum('status', ['menunggu','diterima', 'diterima,jadwal telah diatur ulang', 'selesai'])->default('menunggu');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('janji_temus');
    }
};
