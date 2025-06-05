<?php

use App\Http\Middleware\UserLogMW;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Support\Facades\Route;
use App\Models\UserLog;
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
Route::get('/mera_vesa', [MainController::class, 'mera_vesa'])->name('mera_vesa');
Route::get('/cat/{slug}', [CategoriesController::class, 'index'])->name('cat');
Route::get('/avtor/{id}', [CategoriesController::class, 'avtor'])->name('avtor');
Route::any('/search', [CategoriesController::class, 'search'])->name('search');
Route::get('/pdf/{slug}', [RecipesController::class, 'pdf_recipe'])->name('recipe.pdf');

Route::middleware([UserLogMW::class])->group(function () {
    Route::get('/recipe/{slug}', [RecipesController::class, 'index'])->name('recipe');
    Route::get('/fav', [CategoriesController::class, 'favorite'])->name('fav')->middleware('auth');
});

Route::get('/recipe/{id}/fav/{status}', [RecipesController::class, 'in_favorite'])->name('InFavorite');
Route::post('/comment', [RecipesController::class, 'add_comment'])->name('comment.add');
Route::get('/about', [StatisticsController::class, 'statistic'])->name('about');

//Route::post('/about/dellogs}', [StatisticsController::class, 'deletelogs'])->name('dellogs');

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::post('/register', [UserController::class, 'store'])->name('user.store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
    Route::get('/login/yandex', [UserController::class, 'yandex'])->name('yandex');
    Route::get('/login/yandex/callback', [UserController::class, 'yandexCallback'])->name('yandexCallback');
    Route::get('/login/telegram', [UserController::class, 'telegram'])->name('telegram');
    Route::get('/login/telegram/callback', [UserController::class, 'telegramCallback'])->name('telegramCallback');

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [UserController::class, 'save'])->name('user.profile.save');
    Route::post('/profile/delсomment/{id}', [UserController::class, 'delсomment'])->name('delсomment');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/new', [RecipesController::class, 'new_recipe'])->name('recipe.new');
    Route::post('/new', [RecipesController::class, 'add_recipe'])->name('recipe.add');
    Route::get('/edit/{slug}', [RecipesController::class, 'edit_recipe'])->name('recipe.edit');
    Route::post('/edit/{slug}', [RecipesController::class, 'upd_recipe'])->name('recipe.upd');
    Route::get('/del/{slug}', [RecipesController::class, 'del_recipe'])->name('recipe.del');

});
// Route::get('/clear', function () {
//     Artisan::call('cache:clear');
//     Artisan::call('config:cache');
//     Artisan::call('view:clear');
//     Artisan::call('route:clear');
//     return "Сброс кэша выполнен!"; 
// });