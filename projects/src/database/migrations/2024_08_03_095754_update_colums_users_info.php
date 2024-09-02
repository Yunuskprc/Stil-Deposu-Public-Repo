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
            $table->dropColumn(['debit_number', 'debit_ex_date', 'debit_cvv', 'debit_holder_name']);
              $table->json('cards')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_info', function (Blueprint $table) {
            $table->dropColumn('cards');
            $table->bigInteger('debit_number')->nullable();
            $table->string('debit_ex_date')->nullable();
            $table->integer('debit_cvv')->nullable();
            $table->string('debit_holder_name')->nullable();
        });
    }
};