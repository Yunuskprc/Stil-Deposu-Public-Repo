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
        Schema::create('basket', function (Blueprint $table) {
            $table->engine ="InnoDB";
            $table->id('basket_id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->json('products');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basket');
    }
};