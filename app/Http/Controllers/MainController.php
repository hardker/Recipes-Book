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
    public function search(Request $request) {
        $query = $request->input('query');


        $results = Recipe::where('title','LIKE','%'.$query.'%')
        ->orWhere('description','LIKE','%'.$query. '%')
        ->orWhere('ingredients','LIKE','%'.$query.'%')
        ->orWhere('timing','LIKE','%'.$query.'%')     
        ->orWhere('calorie','LIKE','%'.$query.'%')               
        ->get();
      //  dd ($query);
        
        return view('search', ['results' => $results, 'query' => $query]);
    }
}
