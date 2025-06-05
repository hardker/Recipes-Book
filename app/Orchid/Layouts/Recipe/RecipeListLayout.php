<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Recipe;

use Carbon\Carbon;
use App\Models\Recipe;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Illuminate\View\Component;

class RecipeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'recipes';
    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', '№')->cantHide()->width('10')->sort(),

            TD::make('path', 'Фото')->width('70')
                ->render(fn ($images) => view('components.view_img', ['images' => $images,])),

            TD::make('title', 'Название')->filter(TD::FILTER_TEXT)->width('200')->sort(),

            TD::make('slug', 'Уникальный URL')->sort()->cantHide()->filter(TD::FILTER_TEXT),

            TD::make('category_id', 'Категория')->width('100')->sort()
                ->render(fn ($model) => $model->category->name_cat),

            TD::make('user_id', 'Автор')->width('100')->sort()
                ->render(fn ($model) => $model->user->name),

            TD::make('edit_id', 'Модератор')->width('100')->sort()
                ->render(fn ($model) => is_null($model->editor) ? null : $model->editor->name),

            TD::make('comments_avg_rating', 'Рейтинг')->width('50')->sort()
            //->asComponent(Number::class, ['decimals' => 1, 'decimal_separator' => ',',])
            ,

            TD::make('created_at', 'Дата создания')->defaultHidden()->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make('updated_at', 'Дата обновления')->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make('deleted_at', 'Дата удаления')->filter(TD::FILTER_DATE_RANGE)->sort()
                ->render(fn ($model) => is_null($model->deleted_at) ? null : Carbon::parse($model->deleted_at)
                    ->format('d.m.Y H:i:s')),

            TD::make(__('Actions'))->align(TD::ALIGN_CENTER)->width('10px')->cantHide()
                ->render(function (Recipe $recipe) {
                    if ($recipe->trashed()) {
                        return DropDown::make()->icon('bs.three-dots-vertical')->list([
                            Button::make('Восстановить')
                                ->icon('bs.recycle')
                                ->method('recover', ['id' => $recipe->id,]),
                        ]);
                    } else {
                        if (is_null($recipe->edit_id)) {
                            return DropDown::make()->icon('bs.three-dots-vertical')->list([

                                Button::make('Опубликовать')
                                    ->icon('bs.shield-check')
                                    ->method('enable', ['id' => $recipe->id,]),
                                Link::make(__('view'))
                                    ->route('recipe.edit', $recipe->slug)
                                    ->icon('bs.pencil'),

                            ]);
                        } else {
                            return DropDown::make()->icon('bs.three-dots-vertical')->list([

                                Button::make('Снять с публикации')
                                    ->icon('bs.shield-slash')
                                    ->method('disable', ['id' => $recipe->id,]),

                                Link::make(__('Edit'))
                                    ->route('recipe.edit', $recipe->slug)
                                    ->icon('bs.pencil'),

                                Button::make(__('Delete'))
                                    ->icon('bs.trash3')
                                    ->method('remove', ['id' => $recipe->id,]),
                            ]);

                        }

                    }
                }),
        ];
    }
}
