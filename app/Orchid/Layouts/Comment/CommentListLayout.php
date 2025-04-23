<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Comment;


use App\Models\Comment;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;


class CommentListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'comments';
    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', '№')->cantHide()->width('60')->sort(),

            TD::make('recipe_id', 'Рецепт')->width('110')->sort()
                ->render(fn ($model) => is_null($model->recipe) ?
                    //  "<img src='../img/img_not_found.gif' alt='recipes not found'class='mw-100 d-block img-fluid rounded-1 w-100'>"
                    "<b style='color:#dc3545'> Рецепт удален </b> " : $model->recipe->title),
            //     ->render(fn ($model) => dd($model)),

            TD::make('name', 'Автор')->cantHide()->filter(TD::FILTER_TEXT)->width('120')->sort(),

            TD::make('email', 'Почта автора')->defaultHidden()->width('120')->filter(TD::FILTER_TEXT)->sort(),

            TD::make('comment', 'Комментарий')->filter(TD::FILTER_TEXT)->width('400'),

            TD::make('rating', 'Рейтинг')->width('30')->sort()->align(TD::ALIGN_CENTER),

            TD::make('created_at', 'Дата создания')->defaultHidden()->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make('updated_at', 'Дата обновления')->filter(TD::FILTER_DATE_RANGE)->sort()
                ->usingComponent(DateTimeSplit::class, upperFormat: 'd.m.Y', lowerFormat: 'H:i:s'),

            TD::make(__('Actions'))->align(TD::ALIGN_CENTER)->width('10px')
                ->render(function (Comment $comment) {
                    return
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            //->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', ['id' => $comment->id,])
                    ;
                }),
        ];
    }
}
