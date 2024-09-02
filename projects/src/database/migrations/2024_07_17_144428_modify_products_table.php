<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'product_name',
                'product_short_desc',
                'product_long_desc',
                'product_price',
                'product_stock',
                'is_for_sale',
                'product_images'
            ]);

            // Yeni product_detail sütunu ekle
            $table->json('product_detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Yeni product_detail sütununu kaldır
            $table->dropColumn('product_detail');

            // Eski sütunları geri ekle
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

            // İlişkileri tekrar tanımla
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
        });
    }
}
