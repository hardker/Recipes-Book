<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Category;

use App\Orchid\Layouts\Category\CategoryListLayout;
use App\Models\Category;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class CategoryListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'categories' => Category::withTrashed()->filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Редактор категорий рецептов';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Полный список всех категорий, включая удаленные. С возможностью сортировки и фильтрации данных.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.categories',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.categories.create')),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            CategoryListLayout::class,
        ];
    }
    public function remove(Request $request): void
    {
        Category::findOrFail($request->get('id'))->delete();
        Toast::info('Категория успешно удалена');
    }
    public function recover(Request $request): void
    {
        Category::withTrashed()->find($request->get('id'))->restore();
        Toast::info('Категорият успешно восстановлена');
    }
}
