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
        $data['title'] = $category->name_cat;
        $data['recipes'] =  Recipe::where('category_id', $category->id)->get();
         dd($data);
        return view('/category', $data);
    }
    public function favorite()
    {
        $data['title'] = "Избранные рецепты";
        $data['status'] = Like::where('user_id', Auth::id())->where('status', True)->get();
     //   dd($data);     
       $data['recipes'] = Recipe::where('id',  $data['status']->recipe_id)->first();
              dd($data);         
        return view('/category', $data);
    }
}
