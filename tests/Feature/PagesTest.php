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

    public function test_home_screen(): void
    {
        $response = $this->get('/');
        $response->assertOk()->assertViewIs('home')->assertViewHas('categories');
    }

    public function test_registration_screen(): void
    {
        $response = $this->get('/register');
        $response->assertOk()->assertViewIs('user.create');
    }

    public function test_new_users()
    {
        User::factory()->count(20)->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $this->assertAuthenticated();
        $response->assertOk();
    }
    public function test_guest_cannot_access_recipe_new()
    {
        $response = $this->get('/new');
        $response->assertRedirect('/login');
    }

    public function test_search()
    {
        $response = $this->post('/search', ['search' => 'соль']);
        $response->assertOk();

    }
    public function test_new_recipe()
    {
        $user = User::inRandomOrder()->first();
        $recipe = Recipe::factory()->recycle($user)->create();
        $response = $this->actingAs($user)->get("/recipe/{$recipe->slug}");
        $response->assertOk();
        $response->assertViewHas('recipe', $recipe);

    }
    public function test_new_comment()
    {
        Comment::factory()->count(20)->create();
        $response = $this->post('/comment');
        $response->assertFound();
    }
    public function test_favorite()
    {
        $user = User::inRandomOrder()->first();
        $this->actingAs($user);
        $recipe = Recipe::factory()->recycle($user)->create();
        $this->get('/recipe/'.$recipe->id.'/fav/1');
         $this->assertDatabaseHas('likes', [
            'status' => 1,
            'recipe_id' => $recipe->id,
            'user_id' => $user->id,
        ]);

    }
}
