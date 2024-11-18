<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\RecipesController;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();
        // dump($category->toArray());
        $data['title'] = $category->name_cat;
        $data['bread'] = 'Книга';
        $data['recipes'] = Recipe::select()->where('category_id', $category->id)->withAvg('comments', 'rating')->paginate(5);

        //        dump($data);
        return view('category', $data);
    }

    public function favorite()
    {
        $data['title'] = 'Избранные рецепты';
        $data['bread'] = 'Избранное';
        $data['recipes'] = Recipe::Join('likes', 'recipes.id', 'likes.recipe_id')->where('user_id', Auth::id())->where('status', true)->orderBy('likes.updated_at', 'DESC')->withAvg('comments', 'rating')->paginate(5);

        //      dump($data);
        return view('category', $data);
    }

    public function search(Request $request)
    {
        $data['title'] = 'Поиск по рецептам';
        $data['bread'] = 'Поиск';
        $query = $request->input('query');
        $data['recipes'] = Recipe::where('title', 'LIKE', '%'.$query.'%')
            ->orWhere('description', 'LIKE', '%'.$query.'%')
            ->orWhere('ingredients', 'LIKE', '%'.$query.'%')
            ->orWhere('timing', 'LIKE', '%'.$query.'%')
            ->orWhere('calorie', 'LIKE', '%'.$query.'%')
            ->paginate(5);

        //    dump($data);
        return view('category', $data);

    }
}
