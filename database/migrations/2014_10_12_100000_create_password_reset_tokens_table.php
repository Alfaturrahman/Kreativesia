<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        DB::unprepared('
        CREATE EVENT delete_expired_tokens
        ON SCHEDULE EVERY 15 minute
        DO
            DELETE FROM password_reset_tokens WHERE created_at < NOW() - INTERVAL 1 HOUR;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP EVENT IF EXISTS delete_expired_tokens');
        Schema::dropIfExists('password_reset_tokens');
    }
};
