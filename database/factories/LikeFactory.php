<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Recipe;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-6 months');
        return [
            //
            'user_id' => User::factory(),
            'recipe_id' => rand(1, Recipe::count()),
            'status' => true,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
