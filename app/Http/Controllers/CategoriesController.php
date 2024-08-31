<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Http\Controllers\RecipesController;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index($slug)
    {
        $category = Category::where("slug", $slug)->first();
        $data['title'] = $category->name_cat;
        $data['recipes']=Recipe::where('category_id', $category->id)->get();
        return view('/category', $data);
    }
}
