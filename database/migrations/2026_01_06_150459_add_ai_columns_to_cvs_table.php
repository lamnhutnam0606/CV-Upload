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
        Schema::table('cvs', function (Blueprint $table) {
            $table->string('phone')->nullable()->unique()->after('email');
            $table->text('ai_result')->nullable()->after('raw_text');
            $table->string('ai_status', 50)->nullable()->after('ai_result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->dropColumn(['phone', 'ai_result', 'ai_status']);
        });
    }
};
