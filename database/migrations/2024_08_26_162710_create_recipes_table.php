<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('title')->unique();
            $table->text('description')->nullable();//Описание рецепта
            $table->mediumText('text');//Приготовление рецепта
            $table->text('ingredients');//Ингредиенты рецепта
            $table->text('timing')->nullable();//Время приготовление рецепта
            $table->bigInteger('calorie')->nullable();//Калорийность рецепта            
            $table->string('slug')->unique();
            $table->string('path')->nullable();//Путь до фото с именем файла 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
