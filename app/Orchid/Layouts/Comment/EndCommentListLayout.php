<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Comment;

use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;


class EndCommentListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'end_comments';

    public $title = '10 крайних комментариев пользователей';
    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            //TD::make('id', '№')->cantHide()->width('60')->sort(),
            TD::make('updated_at', 'Дата')->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.y', lowerFormat: '')->cantHide(),

            TD::make('recipe_id', 'Рецепт')
                ->render(fn ($model) => is_null($model->recipe) ?
                    //  "<img src='../img/img_not_found.gif' alt='recipes not found'class='mw-100 d-block img-fluid rounded-1 w-100'>"
                    "<b style='color:#dc3545'> Рецепт удален </b> " : $model->recipe->title)->cantHide(),
            //     ->render(fn ($model) => dd($model)),
            TD::make('comment', 'Комментарий')->cantHide(),

            TD::make('name', 'Автор')->cantHide(),

        ];
    }
    /**
     * @return bool
     */
    protected function hoverable(): bool
    {
        return true;
    }
    protected function compact(): bool
    {
        return true;
    }
}
