<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Recipe;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TopRecipeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'top_recipes';

    public $title = '10 лучших рецептов по мнению пользователей';
    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', 'Название')->cantHide(),

            TD::make('user_id', 'Автор')->render(fn ($model) => $model->user->name)->cantHide(),

            TD::make('comments_avg_rating', 'Рейтинг')->cantHide()->align(TD::ALIGN_CENTER),
        ];
    }
    protected function hoverable(): bool
    {
        return true;
    }
    protected function compact(): bool
    {
        return true;
    }
}
