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
        Schema::table('users_info', function (Blueprint $table) {
            // 'adress' sütununu JSON olarak değiştirme
            $table->json('adress')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_info', function (Blueprint $table) {
            // Geri alırken sütun tipini tekrar string yapma
            $table->string('adress')->nullable()->change();
        });
    }
};