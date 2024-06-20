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
        Schema::create('laporan_konsultasi', function (Blueprint $table) {
            $table->bigIncrements('id_laporan_konsultasi');
            $table->bigInteger('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_pt');
            $table->foreign('kode_pt')->references('kode_pt')->on('perguruan_tinggi')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('no_str');
            $table->foreign('no_str')->references('no_str')->on('psikolog')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_janji_temu');
            $table->foreign('id_janji_temu')->references('id_janji_temu')->on('janji_temu')->onDelete('cascade')->onUpdate('cascade');
            $table->text('laporan_perguruan_tinggi');
            $table->text('catatan_mahasiswa');
            $table->enum('tingkat_permasalahan', ['ringan', 'sedang', 'berat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_konsultasis');
    }
};
