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
        Schema::create('verify_codes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('code_id');
            $table->unsignedBigInteger('user_id');
            $table->string('verify_code');
            $table->boolean('isComp');
            $table->boolean('isExp');
            $table->timestamp('expires_at')->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_codes');
    }
};
