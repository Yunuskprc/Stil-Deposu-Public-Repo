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
        Schema::create('waiting_sold_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('waiting_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('brand_id');
            $table->json('products'); // Burada product_id count değelerini eklemek mantıklı.
            $table->json('order_address');
            $table->json('order_debit_card');
            $table->integer('is_completed')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiting_sold_products');
    }
};