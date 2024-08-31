<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    public function index($slug){
    return view('/recipe');
}
}