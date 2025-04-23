<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Carbon\Carbon;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Recipe\TopRecipeListLayout;
use App\Models\Recipe;
use App\Orchid\Layouts\Comment\EndCommentListLayout;
use App\Models\Comment;
use App\Orchid\Layouts\Recipe\TopUserListLayout;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Like;

class PlatformScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'top_recipes' => Recipe::with('user')
                ->withAvg('comments', 'rating')
                ->defaultSort('comments_avg_rating', 'desc')->take(10)->get(),
            'top_users' => User::withCount('recipes')
                ->defaultSort('recipes_count', 'desc')->take(10)->get(),
            'end_comments' => Comment::with('recipe')
                ->defaultSort('updated_at', 'desc')->take(10)->get(),
            'metrics' => [
                //'sales'    => ['value' => number_format(6851), 'diff' => 10.08],
                'users' => ['value' => number_format(User::count()), 'diff'
                    => number_format(User::whereDate('created_at', Carbon::today())->count())],
                'visitors' => ['value' => number_format(UserLog::whereDate('created_at', Carbon::today())
                    ->count()), 'diff' => number_format(UserLog::whereDate('created_at', Carbon::today())
                        ->count()) / (number_format(UserLog::whereDate('created_at', Carbon::yesterday())
                            ->count()) + 0.01)],
                'rating' => ['value' => Comment::avg('rating'), 'diff' => 0],
                'fav' => ['value' => number_format(Like::count()), 'diff' => 0],
            ],

        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Панель администратора';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Добро пожаловать в панель администрирования.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::metrics([
                'Всего пользователей' => 'metrics.users',
                'Визитов сегодня' => 'metrics.visitors',
                'Средняя оценка' => 'metrics.rating',
                'В избранном' => 'metrics.fav',
            ]),
            Layout::columns([

                TopRecipeListLayout::class,
                TopUserListLayout::class,
            ]),
            EndCommentListLayout::class,
            // Layout::view('platform::partials.update-assets'),
            // Layout::view('platform::partials.welcome'),
        ];
    }
}
