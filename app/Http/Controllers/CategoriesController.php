<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\RecipesController;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();
        //dump($category->toArray());
        $data['title'] = $category->name_cat;
        $data['bread'] = 'Книга';
        $data['recipes'] = Recipe::whereNotNull('edit_id')
            ->where('category_id', $category->id)
            ->withAvg('comments', 'rating')
            ->orderBy('comments_avg_rating', 'DESC')
            ->paginate(5);
        //dump($data);
        return view('category', $data);
    }

    public function favorite()
    {
        $data['title'] = 'Избранные рецепты';
        $data['bread'] = 'Избранное';
        $data['recipes'] = Recipe::LeftJoin('likes', 'recipes.id', 'likes.recipe_id')
            ->whereNotNull('edit_id')
            ->where('likes.user_id', Auth::id())
            ->where('likes.status', true)
            ->withAvg('comments', 'rating')
            ->orderBy('likes.updated_at', 'DESC')
            ->paginate(5);

        //  dump($data);
        return view('category', $data);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $data['title'] = 'Поиск по рецептам <<'.$query.'>>';
        $data['bread'] = 'Поиск';
        $data['recipes'] = Recipe::whereNotNull('edit_id')
            ->whereAny(['title', 'description', 'ingredients', 'timing', 'calorie'], 'LIKE', '%'.$query.'%')
            ->withAvg('comments', 'rating')
            ->paginate(5);
        //dump($data);
        return view('category', $data);
    }

    public function avtor($id)
    {
        $data['title'] = 'Рецепты '.User::find($id)->name;
        $data['bread'] = 'Рецепты пользователей';

        $data['recipes'] = Recipe::whereNotNull('edit_id')
            ->where('user_id', $id)
            ->withAvg('comments', 'rating')
            ->orderBy('comments_avg_rating', 'DESC')
            ->paginate(5);

        // dump($data);
        return view('category', $data);
    }
}
