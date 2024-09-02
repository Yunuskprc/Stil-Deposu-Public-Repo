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
        Schema::table('brands', function (Blueprint $table) {
            $table->string('logoURI')->nullable()->after('brands_name');
            $table->string('cardImageURI')->nullable()->after('logoURI');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('logoURI');
            $table->dropColumn('cardImageURI');
        });
    }
};
