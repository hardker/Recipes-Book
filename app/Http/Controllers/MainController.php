<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;

class MainController extends Controller
{
    // Запрос категорий
    public function index()
    {
        $categories = Category::all();
        //   dump($categories);
        $recipesCarousel = Recipe::withAvg('comments', 'rating')->orderBy('comments_avg_rating', 'DESC')->limit(5)->get();
        return view('home', compact('categories', 'recipesCarousel'));
    }

    public function mera_vesa()
    {
        $data['title'] = 'Меры веса продуктов';
        $data['bread'] = 'Меры веса';
        return view('mera_vesa', $data);
    }
}
