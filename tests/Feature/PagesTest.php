<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\Like;
class PagesTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_home_screen() : void
    {
        $response = $this->get('/');
        $response->assertOk()->assertViewIs('home')->assertViewHas('categories');
    }



    public function test_registration_screen() : void
    {
        $response = $this->get('/register');
        $response->assertOk()->assertViewIs('home');
    }

    public function test_new_users()
    {
        User::factory()->count(20)->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $this->assertAuthenticated();
        $response->assertOk();
    }

    public function test_search()
    {
        $response = $this->post('/search', ['search' => 'соль']);
        $response->assertOk();

    }
    public function test_new_recipe()
    {
        $user = User::inRandomOrder()->first();
        $recipe = Recipe::factory()->create();
        $response = $this->actingAs($user)->get("/recipe/{$recipe->slug}");
        $response->assertOk();
        $response->assertViewHas('recipe', $recipe);
    }
    public function test_new_comment()
    {
        Comment::factory()->count(200)->create();
        $response = $this->post('/comment');
        $response->assertFound();
    }
    public function test_favorite()
    {
        $user = User::all();
        Like::factory()->count(100)->recycle($user)->create();
    }
}
