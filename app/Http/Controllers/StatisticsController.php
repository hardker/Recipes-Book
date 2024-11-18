<?php

namespace App\Http\Controllers;

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


        return view('about', compact(
            'totalRecipe',
            'totalComments',
            'totalUsers',
            'totalViews',
            'logs',
            'totalRating',
            'totalFav',
            // 'postsByMonth',
            // 'commentsByMonth',
            // 'analyticsData',
            // 'lastLoginByDay',
        ));

    }

    public function deletelog($id)
    {
        UserLog::destroy($id);
        return redirect()->back()->with('msg_success', 'Строка успешно удалена!');;
    }

    public function deletelogs()
    {
        UserLog::truncate();
        return redirect()->back()->with('msg_success', 'Лог успешно очищен!');;
    }
}
