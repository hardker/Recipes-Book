<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Recipe;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // Запрос категорий 
    public function index()
    {
        $categories = Category::all();
        //     dd($cat);   
        $recipes = Recipe::all();
        //             dd($recip;
        return view('home', compact('categories', 'recipes'));

    }
    public function getRecipesByCategory($slug)
    {
        // $categories = Category::orderBy('name_cat')->get();
        // $current_category = Category::where('slug', $slug)->first();
        // return view('home', [
        //     'categories' =>  $categories,
        //     'recipes' => $current_category -> recipes(),

        // ]);
    }
}
