<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\RecipesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/cat/{slug}', [CategoriesController::class, 'index'])->name('cat');
Route::get('/recipe/{slug}', [RecipesController::class, 'index'])->name('recipe');

//Route::get('cat/{slug}', [MainController::class, 'getRecipesByCategory'])->name('getRecipesByCategory');

Route::get('/about', function () {
    return view('about');
});