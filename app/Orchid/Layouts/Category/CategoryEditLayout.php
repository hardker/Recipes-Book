<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Category;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Rows;

class CategoryEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('category.name_cat')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name'))
                ->help('Имя категории для отображения'),

            Input::make('category.slug')
                ->type('text')
                ->max(255)
                ->required()
                ->title('Уникальный URL')
                ->placeholder('Уникальный URL')
                ->help(__('Actual name in the system')),

            TextArea::make('category.description')
                ->rows(5)
                ->type('text')
                ->max(255)
                ->required()
                ->title('Описание категории')
                ->placeholder('Описание категории')
                ->help('Описание категории'),

            Picture::make('path')
            ->path('/')
            ->targetRelativeUrl(),
        ];
    }
}
