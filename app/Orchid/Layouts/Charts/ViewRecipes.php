<?php

namespace App\Orchid\Layouts\Charts;

use Orchid\Screen\Layouts\Chart;

class ViewRecipes extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Динамика просмотров';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'line';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'pageViewsByDate';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;

    protected $lineOptions = [
        'spline'     => 1,
        'regionFill' => 1,
        'hideDots'   => 0,
        'hideLine'   => 0,
        'heatline'   => 0,
        'dotSize'    => 3,
    ];

}
