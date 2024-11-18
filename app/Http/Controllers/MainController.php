<?php

namespace App\Http\Controllers;

use App\Models\Category;

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
