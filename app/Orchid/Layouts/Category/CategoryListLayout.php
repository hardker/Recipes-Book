<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Category;

use Carbon\Carbon;
use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'categories';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', '№')->cantHide()->width('10')->sort(),

            TD::make('path', 'Фото')->width('70')
                ->render(fn ($images) => view('components.view_img', ['images' => $images,])),

            TD::make('name_cat', __('Name'))->width('200')->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
            ->render(fn (Category $category) => Link::make($category->name_cat)
            ->route('platform.categories.edit', $category->id))
            ,

            TD::make('slug', 'Уникальный URL')->sort()->cantHide()->filter(Input::make()),

            TD::make('created_at', 'Дата создания')->defaultHidden()->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make('updated_at', 'Дата обновления')->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make('deleted_at', 'Дата удаления')->filter(TD::FILTER_DATE_RANGE)->sort()
                ->render(fn ($model) => is_null($model->deleted_at) ? null : Carbon::parse($model->deleted_at)
                    ->format('d.m.Y H:i:s')),
        ];
    }
}
