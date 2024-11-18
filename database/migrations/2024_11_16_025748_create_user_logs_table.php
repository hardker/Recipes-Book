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
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->BigInteger('user_id')->nullable(); //Пользователь (может не быть)
 //           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('url');  // Адрес страницы
           // $table->string('platform')->nullable();// Платформа пользователя
            $table->string('ip');// IP пользователя
            $table->string('agent')->nullable();// Браузер пользователя
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_logs');
    }
};
