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
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('product_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('category_name');
            $table->string('brand_name');
            $table->string('product_name');
            $table->string('product_short_desc');
            $table->string('product_long_desc');
            $table->string('product_price');
            $table->string('product_stock');
            $table->integer('is_for_sale')->default(1);
            $table->json('product_images')->nullable();

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
