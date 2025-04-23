<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Recipe;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;


class TopUserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'top_users';

    public $title = '10 лучших пользователей по количеству рецептов';
    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', '№')->cantHide(),

            TD::make('name', 'Автор')->cantHide(),

            TD::make('email', 'Почта')->cantHide(),

            TD::make('recipes_count', 'Рецептов')->cantHide()->align(TD::ALIGN_CENTER),
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
