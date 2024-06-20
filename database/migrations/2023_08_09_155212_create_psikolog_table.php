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
        Schema::create('psikolog', function (Blueprint $table) {
            $table->bigInteger('no_str')->primary();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_pt');
            $table->foreign('kode_pt')->references('kode_pt')->on('perguruan_tinggi')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_psikolog');
            $table->string('email')->unique();
            $table->string('alumni');
            $table->enum('status',['offline', 'online', 'sibuk'])->default('offline');
            $table->string('no_telp');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psikologs');
    }
};
