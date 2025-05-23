<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Recipe;
use App\Models\Comment;
use App\Models\Like;

class StatisticsController extends Controller
{
    public function statistic()
    {
        $totalRecipe = Recipe::count();
        $totalComments = Comment::count();
        $totalUsers = User::count();
        $totalViews = UserLog::count();
        $totalRating = Comment::avg('rating');
        $totalFav = Like::count();
        $logs = UserLog::latest()->get();


        // Данные для графиков
        $recipesByMonth = $this->getRecipesByMonth();
        // Проверка данных
        if (empty($recipesByMonth['labels']) || empty($recipesByMonth['data'])) {
            $recipesByMonth = ['labels' => [], 'data' => []];
        }

        $commentsByMonth = $this->getCommentsByMonth();
        if (empty($commentsByMonth['labels']) || empty($commentsByMonth['data'])) {
            $commentsByMonth = ['labels' => [], 'data' => []];
        }
        $statisticsData = $this->getStatisticsData();
        if (empty($statisticsData['pageViews']) && empty($statisticsData['linkClicks']) && empty($statisticsData['timeOnSite'])) {
            $statisticsData = ['pageViews' => 0, 'linkClicks' => 0, 'timeOnSite' => 0];
        }

        $recipesByCategories = $this->getRecipesByCategories();

        //dump($recipesByCategories);

        return view('about', compact(
            'totalRecipe',
            'totalComments',
            'totalUsers',
            'totalViews',
            'logs',
            'totalRating',
            'totalFav',
            'recipesByMonth',
            'commentsByMonth',
            'statisticsData',
            'recipesByCategories',
        ));

    }

    public function deletelog($id)
    {
        UserLog::destroy($id);
        return redirect()->back()->with('msg_success', 'Строка успешно удалена!');
        ;
    }

    // public function deletelogs()
    // {
    //     UserLog::truncate();
    //     return redirect()->back()->with('msg_success', 'Лог успешно очищен!');
    // }


    // Рецепты за месяц
    private function getRecipesByMonth()
    {
        $recipes = Recipe::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'labels' => $recipes->pluck('month'),
            'data' => $recipes->pluck('count')
        ];
    }
    // Комментарии за месяц
    private function getCommentsByMonth()
    {
        $comments = Comment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month,COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'labels' => $comments->pluck('month'),
            'data' => $comments->pluck('count')
        ];
    }
    // Статистика просмотров
    private function getStatisticsData()
    {
        // Группируем просмотры по датам
        $pageViewsByDate = UserLog::selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $pageViews = $pageViewsByDate->sum('views'); // Общее количество просмотров
        // $linkClicks = Analytic::where('event_type', 'link_click')->count();
        // $timeOnSite = Analytic::where('event_type', 'time_on_site')->count();


        return [
            'pageViews' => $pageViews,
            'data' => $pageViewsByDate->pluck('views')->toArray(),
            'labels' => $pageViewsByDate->pluck('date')->toArray(),
            // 'linkClicks' => $linkClicks,
            // 'timeOnSite' => $timeOnSite
        ];
    }

    // Рецепты по категориям
    private function getRecipesByCategories()
    {
        $category = Category::select('id', 'name_cat')->withCount('recipes as count')
            ->orderBy('id')
            ->get();

        return [
            'labels' => $category->pluck('name_cat')->toArray(),
            'data' => $category->pluck('count')->toArray(),
        ];
    }
}
