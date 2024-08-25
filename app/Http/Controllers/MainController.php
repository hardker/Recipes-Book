<?php

namespace App\Http\Controllers;
use App\Models\Category;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // Запрос категорий 
    public function index()
    {
        $categorii = Category::query()->get();
        //        dd($categorii);
        return view('home', ['categorii' => $categorii]);
    }
}
