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
        Schema::create('follow_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('follow_product_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_products');
    }
};
