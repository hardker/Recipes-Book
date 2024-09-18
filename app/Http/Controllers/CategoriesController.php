<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\RecipesController;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index($slug)
    {
        $category = Category::where("slug", $slug)->first();
        // dump($category->toArray());
        $data['title'] = $category->name_cat;
        $data['bread'] = 'Книга';
        $data['recipes'] = Recipe::select()->where('category_id', $category->id)->withAvg('comments', 'rating')->paginate(5);
//        dump($data);
        return view('category', $data);
    }
    public function favorite()
    {
        $data['title'] = "Избранные рецепты";
        $data['bread'] = 'Избранное';
        $data['recipes'] = Recipe::Join('likes', 'recipes.id', 'likes.recipe_id')->where('user_id', Auth::id())->where('status', True)->orderBy('likes.updated_at', 'DESC')->withAvg('comments', 'rating')->paginate(5);
  //      dump($data);
        return view('category', $data);
    }

}
