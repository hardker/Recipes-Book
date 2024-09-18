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
     //   dump($categories);
        return view('home', compact('categories'));

    }

}
