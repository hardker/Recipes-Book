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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id')->unsigned();//Можно заменить на unsignedBigInteger ('user_id')
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->BigInteger('recipe_id')->unsigned();
            $table->foreign('recipe_id')->references('id')->on('recipes')->onDelete('cascade');
            $table->boolean('status')->default(false);
            $table->integer('rating')->default(0);          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
