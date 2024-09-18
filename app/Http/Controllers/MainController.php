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
    public function search(Request $request)
    {
        $data['title'] = "Поиск по рецептам";
        $data['bread'] = 'Поиск';
        $query = $request->input('query');
        $data['recipes'] = Recipe::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orWhere('ingredients', 'LIKE', '%' . $query . '%')
            ->orWhere('timing', 'LIKE', '%' . $query . '%')
            ->orWhere('calorie', 'LIKE', '%' . $query . '%')
            ->paginate(5);
    //    dump($data);
        return view('category', $data);

    }
}
