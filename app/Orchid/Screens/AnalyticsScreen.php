<?php

namespace App\Orchid\Screens;

use App\Models\Comment;
use App\Models\UserLog;
use App\Orchid\Layouts\Charts\DynamicsComments;
use App\Orchid\Layouts\Charts\ViewRecipes;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;


class AnalyticsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Аналитика';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = '';

    public $permission = ['platform.analytics'];

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $comments = Comment::selectRaw('DATE_FORMAT(created_at, "%y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $chart1 = [
            [
                'labels' => $comments->pluck('month'),
                'values' => $comments->pluck('count'),
            ],
        ];
        $viewsByDate = UserLog::selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $chart2 = [
            [
                'labels' => $viewsByDate->pluck('date'),
                'values' => $viewsByDate->pluck('views'),
            ],
        ];
        // dd($charts );
        return [
            'addedComments' => $chart1,
            'pageViewsByDate' => $chart2,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::columns([
                ViewRecipes::class,
                DynamicsComments::class,
            ]),
        ];
    }
}
