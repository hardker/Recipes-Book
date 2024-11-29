<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Recipe;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        $date = fake()->dateTimeBetween('-6 months');
        return [
            //
            'recipe_id' => rand(1, Recipe::count()),
            'name' => fake('ru_RU')->name(),
            'email' => fake()->unique()->safeEmail(),
            'rating' => rand(1, 5),
            'comment' => fake('ru_RU')->realText(),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
