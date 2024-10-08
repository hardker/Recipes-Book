<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\USerController;
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

Route::get('cat/{slug}', [CategoriesController::class, 'index'])->name('cat');
Route::get('fav', [CategoriesController::class, 'favorite'])->name('fav');
Route::get('search', [CategoriesController::class, 'search'])->name('search');

Route::get('recipe/{slug}', [RecipesController::class, 'index'])->name('recipe');
Route::get('recipe/{id}/fav/{status}', [RecipesController::class, 'in_favorite' ])->name('InFavorite');
Route::post('comment',[RecipesController::class, 'add_comment'])->name('comment.add');


Route::get('about', function () { return view('about'); })->name('about');;

Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'loginAuth'])->name('login.auth');
});
Route::middleware('auth')->group(function () {
    // Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('new', [RecipesController::class, 'new_recipe'])->name('recipe.new');
    Route::post('add', [RecipesController::class, 'add_recipe'])->name('recipe.add');
});
